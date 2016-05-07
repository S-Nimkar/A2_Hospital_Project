<?php
session_start();
if ($_SESSION['active'] != "3") {
	header('Location: ../Views/server_error.html');
	die;
}

$host="localhost"; // Host name
$username="root"; // Mysql username
$password="root"; // Mysql password
$db_name="Hospital_Database"; // Database name
$tbl_name="Administrator"; // Table name


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
      <a href="admin_homepage.php" class="sidenavbrand-logo brand-logo center-align tooltipped nav-bar-logo" data-position="right" data-delay="50" data-tooltip="Nimkar Medical Practitioners" >NMP
      </a>
      <a href="#" data-activates="nav-mobile" class="button-collapse top-nav full hide-on-large-only" style="margin-left: 30px;">
        <i class="material-icons">menu</i>
      </a>
    </div>
  </nav>
  <ul id="nav-mobile" class="side-nav fixed" style="transform: translateX(0%);">
    <ul>
      <li class ="logo"><a href="admin_homepage.php" class="sidenav-brandlogo center-align nav-bar-logo " data-position="right" data-delay="50" style=" font-size: 5rem;">NMP
      </a>
    </li>
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header">Doctors</a>
        <div class="collapsible-body">
          <ul>
            <li><a href="admin_doctor_view.php">View Doctors</a></li>
            <li><a href="admin_assigned_patients_view.php">Doctors Tables</a></li>
            <li><a href="admin_add_doctor.php">Add Doctor</a></li>
            <li><a href="admin_remove_doctor.php">Remove Doctor</a></li>
          </ul>
        </div>
      </li>
    </ul>
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header">Patients</a>
        <div class="collapsible-body">
          <ul>
            <li><a href="admin_patient_view.php">View Patients</a></li>
            <li><a href="admin_assigned_patients_view2.php">Assigned Patients</a></li>
            <li><a href="admin_assign_patients.php">Assign Patients</a></li>
            <li><a href="admin_unassign_patients.php">Unassign Patients</a></li>
            <li><li><a href="admin_remove_patient.php">Remove Patients</a></li></li>
          </ul>
        </div>
      </li>
    </ul>
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header">Admins</a>
        <div class="collapsible-body">
          <ul>
            <li><a href="admin_admin_view.php">View Admins</a></li>
            <li><a href="admin_add_admin.php">Add Admins</a></li>
            <li><a href="admin_remove_admin.php">Remove Admins</a></li>
          </ul>
        </div>
      </li>
    </ul>
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header">Forms</a>
        <div class="collapsible-body">
          <ul>
            <li><a href="admin_completed_forms.php">Completed Forms</a></li>
            <li><a href="admin_view_form_requests.php">Requested Forms</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </ul>
  <li style="background-color: #669999;"><a href="../Database/logout.php" >Logout</a></li>
</ul>
</div>
</header>
<body class="registration_success_background">
<div class="container registration-container admin_submitbox">
    <div class="mdl-card z-depth-0 registration-card mdl-shadow-mobile">
      <div class="mdl-card__title card-title-registration center-align">
        <text class="full-width">Assign Patient</text>
      </div>
      <form name="admin_form" method="post" onsubmit="return validateAssign()" action="../Database/assign_patient.php" >
        <div class="registration-card-actions">
        <p>To assign a patient to a doctor you must enter the patients ID below and also the doctors id into the fields.</p>
        <br>
        <?php

          switch($_SESSION['assign_result']){
          case 'nopatient':
            echo "
            <p>Patient was not found to be in the database</p>
            ";
            break;
          case 'nodoctor':
            echo "
            <p>Doctor was not found to be in the database</p>
            ";
            break;
          case 'already_exits':
            echo "
            <p>Patient already exists in doctors database</p>
            ";
            break;
            case 'already_exits':
            echo "
            <p>Patient already exists in doctors database</p>
            ";
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
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-floating-text registration-text-inputs registration-input-widths registration-right">
            <input class="mdl-textfield__input" type="text" pattern="^[0-9]*$" name="doctorid">
            <label class="mdl-textfield__label" for="doctorid">Doctors ID</label>
            <span class="mdl-textfield__error absolute registration-spans" name="did-incorrect">Numbers Only</span>
            <span class="visibility-false absolute" name="did-length">Input is too long! >16 </span>
            <span class="visibility-false absolute registration-spans" name="did-missing">Please enter a ID</span>
          </div>
        </div>
        <div class="registration-card-actions center-align">
          <button class="mdl-button mdl-js-button mdl-button--raised waves-effect waves-light btn-large submit-button submit-margin-bottom" type="submit" name="submit">Assign Patients
          </button>
        </div>
      </form>
    </div>
    </div>
<?php
        $tablecount ="SELECT * FROM Doctor";
        $rowcountresult = mysqli_query($dbc, $tablecount);
        $rowcount = mysqli_num_rows($rowcountresult);
        $rowcheck = $rowcount;

        if ($rowcheck = 0){
          echo "
          <div class=\"container registration_success_content mdl-card admin_text patient_admin_width\" >
              <p class=\"registration_success_title \" style=\"margin-left: 20px;\">Doctors</p>
  
               <table style=\" margin-left: 20px;\">
                 <thead>
                <tr>
              <th data-field=\"doctor_patient_id\">Doctor Patient ID</th>
              <th data-field=\"user_name\">Reference ID</th>
              <th data-field=\"first_name\">First Name</th>
              <th data-field=\"surname\">Surame</th>
              </tr>
        </thead>

        <tbody>

          <tr>
              <td>NO DOCTORS</td>
               </tr>
        </tbody>
        </div>
      ";
        }

        $getdoctoridsql = "SELECT Doctor_ID FROM Doctor";
        $doctorid = mysqli_query($dbc,$getdoctoridsql);
        $currentrow = 0;

        for ($i=0; $i < $rowcount ; $i++) { 
          
          mysqli_data_seek($doctorid,$currentrow);
          $currentid = mysqli_fetch_row($doctorid);
          $getdoctorsnamesql ="SELECT Name FROM Doctor WHERE Doctor_ID = '$currentid[0]'" ;
          $gettablenamesql ="SELECT Username FROM Doctor WHERE Doctor_ID = '$currentid[0]'" ;

          $doctorname = mysqli_query($dbc,$getdoctorsnamesql);
          $table_name = mysqli_query($dbc,$gettablenamesql);

          mysqli_data_seek($doctorname,0);

          $current_username = mysqli_fetch_row($doctorname);
          $current_tablename = $current_username[0];
          $current_tablename .= "'s Patient Table";

          mysqli_data_seek($table_name,0);

          $current_uname = mysqli_fetch_row($table_name);
          $current_tname = $current_uname[0];
          $current_tname .= "_table";

          $getdoctortblsql = "SELECT * FROM $current_tname";
          $doctor_tblresult = mysqli_query($dbc, $getdoctortblsql);

          $getdoctor_patientidsql = "SELECT Doctors_Patient_ID FROM $current_tname";
          $current_doctor_namerowcount = mysqli_query($dbc,$getdoctor_patientidsql);
          $currentnumrows = mysqli_num_rows($current_doctor_namerowcount);

          if ($currentnumrows != 0 ){

        echo " <div class=\"container registration_success_content mdl-card admin_text patientadminbox patient_admin_width\" style =\" margin-top: 4%;\">
              <p class=\"registration_success_title \" style=\"margin-left: 20px; \">Doctor $current_tablename</p>
  
               <table style=\" margin-left: 20px;\">
                 <thead>
                <tr>
                <th> Referential ID </th>
                <th>Patient ID </th>
                <th>Patient Name</th>
              </tr>
        </thead>
        <tbody>
        ";

        for ($i2 =0; $i2 <= $currentnumrows ; $i2 ++) { 
          mysqli_data_seek($doctor_tblresult,$i2);
          $current_dtable_row= mysqli_fetch_row($doctor_tblresult);
          if ($currentnumrows == 0 ){
            echo"
          <tr>
          <th>
          No Patients assigned to doctor.
          </th>
          </tr>
          ";

          break;
          }

          $dpid = $current_dtable_row[0];
          $refid = $current_dtable_row[1];
          $currentpatientname = "";
          $getpatientnamesql = "SELECT FName,SName FROM Patient WHERE Patient_ID = '$refid'";
          $patientnameresult = mysqli_query($dbc,$getpatientnamesql);
          mysqli_data_seek($patientnameresult,0);
          $current_patientname_row = mysqli_fetch_row($patientnameresult);
          $currentpatientname .= $current_patientname_row[0];
          $currentpatientname .= " ";
          $currentpatientname .= $current_patientname_row[1];

          echo"
          <tr>
          <th>
          $dpid
          </th>
          <th>
          $refid
          </th>
          <th>
          $currentpatientname
          </th>
          </tr>

          ";
        }
        $i2 = 0;

        echo "
        </tbody>
        </table>
        </div>
            ";
            $tablescreated += 1;
          }
          $currentrow  = ($currentrow + 1);
            }

            if ($tablescreated ==0) {
              echo "
                <div class=\"container registration_success_content mdl-card admin_text patientadminbox patient_admin_width\" style =\" margin-top: 4%;  min-height: 100px; \">
              <p class=\"registration_success_title \" style=\"margin-left: 20px;\">No Patients Currently Assigned!</p>
              </div>
              ";
            }

            $doctor_details_sql = "SELECT Doctor_ID,Name FROM Doctor";
            $doctor_details = mysqli_query($dbc,$doctor_details_sql);
            $current_number_of_doctors = mysqli_num_rows($doctor_details);
            if ($current_number_of_doctors == 0 ) {
               echo " <div class=\"container registration_success_content mdl-card admin_text patientadminbox patient_admin_width\" style =\" margin-top: 4%;\">
              <p class=\"registration_success_title \" style=\"margin-left: 20px; \">Current Doctors</p>     
                   <table style=\" margin-left: 20px;\">
                     <thead>
                    <tr>
                    <th> Doctors ID </th>
                    <th> Doctors Name </th>
                  </tr>
                </thead>
                <tbody>
                <tr><th>No Doctors!</th></tr></tbody></table>";
            } else {

              echo " <div class=\"container registration_success_content mdl-card admin_text patientadminbox patient_admin_width\" style =\" margin-top: 4%;\">
              <p class=\"registration_success_title \" style=\"margin-left: 20px; \">Current Doctors</p>     
                   <table style=\" margin-left: 20px;\">
                     <thead>
                    <tr>
                    <th> Doctors ID </th>
                    <th> Doctors Name </th>
                  </tr>
                </thead>
                <tbody>";

            for ($doctor_rowdepth=0; $doctor_rowdepth < $current_number_of_doctors; $doctor_rowdepth++) { 
              mysqli_data_seek($doctor_details,$doctor_rowdepth);
              $currentdoctor_dets = mysqli_fetch_row($doctor_details);
              echo "<tr>
              <th>". $currentdoctor_dets[0]."</th>
              <th>". $currentdoctor_dets[1]."</th>
              </tr>"
              ;
            }
            }

        echo "
        </tbody>
        </table>
        </div>
            ";

            $patient_details_sql = "SELECT Patient_ID,FName,SName FROM Patient";
            $patient_details = mysqli_query($dbc,$patient_details_sql);
            $current_number_of_patients = mysqli_num_rows($patient_details);

              echo " <div class=\"container registration_success_content mdl-card admin_text patientadminbox patient_admin_width\" style =\" margin-top: 4%;\">
              <p class=\"registration_success_title \" style=\"margin-left: 20px; \">Current Patients</p>     
                   <table style=\" margin-left: 20px;\">
                     <thead>
                    <tr>
                    <th> Patients ID </th>
                    <th> Patients Name </th>
                  </tr>
                </thead>
                <tbody>";

            for ($patient_rowdepth=0; $patient_rowdepth < $current_number_of_patients; $patient_rowdepth++) { 
              mysqli_data_seek($patient_details,$patient_rowdepth);
              $currentpatient_dets = mysqli_fetch_row($patient_details);
              echo "<tr>
              <th>". $currentpatient_dets[0]."</th>
              <th>". $currentpatient_dets[1]." ". $currentpatient_dets[2] ."</th>
              </tr>"
              ;

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
  <script type="text/javascript" src="../Scripts/assign_patient.js"></script>

    </body>

</html>
