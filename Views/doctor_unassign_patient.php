<?php
session_start();
if ($_SESSION['active'] != "5") {
	header('Location: ../Views/server_error.html');
	die;
}

$host="localhost"; // Host name
$username="root"; // Mysql username
$password="root"; // Mysql password
$db_name="Hospital_Database"; // Database name


// Connect to server and select databse.
$dbc = mysqli_connect("$host", "$username", "$password")or die("cannot connect");
mysqli_select_db($dbc, $db_name) or die("cannot select DB"); 

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
	<link rel="stylesheet" type="text/css" href="../Styles/Minified-Styles/material.min.css">
    <link rel="stylesheet" type="text/css" href="../Styles/Minified-Styles/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" type="text/css" href="../Styles/master.css" media="screen,projection">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<header>
  <nav class = "nav-bar-container patient_admin_width">
    <div class="navbar-fixed">
      <a href="doctor_homepage.php" class="sidenavbrand-logo brand-logo center-align tooltipped nav-bar-logo" data-position="right" data-delay="50" data-tooltip="Nimkar Medical Practitioners" >NMP
      </a>
      <a href="#" data-activates="nav-mobile" class="button-collapse top-nav full hide-on-large-only" style="margin-left: 30px;">
        <i class="material-icons">menu</i>
      </a>
    </div>
  </nav>
  <ul id="nav-mobile" class="side-nav fixed" style="transform: translateX(0%);">
    <ul>
      <li class ="logo"><a href="doctor_homepage.php" class="sidenav-brandlogo center-align nav-bar-logo " data-position="right" data-delay="50" style=" font-size: 5rem;">NMP
      </a>
    </li>
    <li><a href="doctor_profile.php">My Profile</a></li>
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header">Forms</a>
        <div class="collapsible-body">
          <ul>
            <li><a href="">My Completed Forms</a></li>
            <li><a href="doctor_request_form.php">Request Form</a></li>
            <li><a href="">Pending Forms</a></li>
          </ul>
        </div>
      </li>
    </ul>
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header">Patients</a>
        <div class="collapsible-body">
          <ul>
            <li><a href="doctor_my_patients.php">My Patients</a></li>
            <li><a href="doctor_assign_patient.php">Assign Patient</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </ul>
  <li style="background-color: #669999;" ><a href="../Database/logout.php" >Logout</a></li>
</ul>
</header>
<body class="registration_success_background">
<div class="container registration-container admin_submitbox">
    <div class="mdl-card z-depth-0 registration-card mdl-shadow-mobile">
      <div class="mdl-card__title card-title-registration center-align">
        <text class="full-width">Unassign Patient</text>
      </div>
      <form name="admin_form" method="post" onsubmit="return validateAssign()" action="../Database/doc_unassign_patient.php" >
        <div class="registration-card-actions">
        <p>To unassign a patient, enter the patients id into the patient id box below and this will remove the patient from your table.</p>
        <br>
        <?php
        switch ($_SESSION['assign_result']) {
          case "nopatient":
            echo "No patient was found with that id in the database!";
            break;
        }
        $_SESSION['assign_result'] = 'default';
        ?>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-floating-text registration-text-inputs registration-input-widths registration-right">
            <input class="mdl-textfield__input" type="text" pattern="^[0-9]*$" name="patientid">
            <label class="mdl-textfield__label" for="patientid">Patients ID</label>
            <span class="mdl-textfield__error absolute registration-spans" name="pid-incorrect">Numbers Only</span>
            <span class="visibility-false absolute" name="pid-length">Input is too long! >16 </span>
            <span class="visibility-false absolute registration-spans" name="pid-missing">Please enter a ID</span>
          </div>
        </div>
        <div class="registration-card-actions center-align">
          <button class="mdl-button mdl-js-button mdl-button--raised waves-effect waves-light btn-large submit-button submit-margin-bottom" type="submit" name="submit">Unassign Patients
          </button>
        </div>
      </form>
    </div>
    </div>
<?php
 $current_table_name = $_SESSION['session_user_name'];
 $current_table_name .="_table";
    $getpatientid_sql = "SELECT * FROM $current_table_name ";
    $mypatients_result = mysqli_query($dbc,$getpatientid_sql);
    $patientamount = mysqli_num_rows($mypatients_result);
     echo " <div class=\"container registration_success_content mdl-card admin_text patientadminbox patient_admin_width\" style =\" margin-top: 4%;\">
              <p class=\"registration_success_title \" style=\"margin-left: 20px; \">My Current Patients</p>
  
               <table style=\" margin-left: 20px;\">
                 <thead>
                <tr>
                <th> Patient ID </th>
                <th>Patient Name</th>
                <th>Patient Email</th>
              </tr>
        </thead>
        <tbody>
        ";
      if ($patientamount == 0) {
        echo "<tr><th>No Patients Assigned currently!</th></tr>";
      } else {
    for ($i=0; $i < $patientamount; $i++) { 
      mysqli_data_seek($mypatients_result,$i);
      $fetchedid = mysqli_fetch_row($mypatients_result);
      echo "<tr><th>".$fetchedid[1]."</th>";
      $test = $fetchedid[1];
      $getpateintinfo_sql= "SELECT * FROM Patient WHERE Patient_ID = '$test'";
      $pateintinfo_result = mysqli_query($dbc,$getpateintinfo_sql);
      mysqli_data_seek($pateintinfo_result,0);
      $fetched_pdata = mysqli_fetch_row($pateintinfo_result);
      echo "<th>".$fetched_pdata[1]." ".$fetched_pdata[2]."</th>";
      echo "<th>".$fetched_pdata[3]."</th></tr>";
    }
  }
    echo "
        </tbody>
        </table>
        </div>
            ";

 ?>

      <script type="text/javascript" src="../Scripts/Minified-Scripts/jquery-2.2.1.min.js"></script>
  <script type="text/javascript" src="../Scripts/Minified-Scripts/materialize.min.js"></script>
  <script type="text/javascript" src="../Scripts/Minified-Scripts/material.min.js"></script>
  <script type="text/javascript" src="../Scripts/admin_homepage.js"></script>
  <script type="text/javascript" src="../Scripts/doctor_assign_patient.js"></script>

    </body>

</html>
