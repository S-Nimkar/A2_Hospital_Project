<?php 
session_start();
if ($_SESSION['active'] != "5") {
	header('Location: ../Views/server_error.html');
	die;
	//forward to server generic error access
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
		<li><a href="">My Profile</a></li>
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
		<li><a href="doctor_my_patients">My Patients</a></li>
	</ul>
	<li><a href="../Database/logout.php" style="background-color: #669999;">Logout</a></li>
</div>
</header>
<body class="registration_success_background">
	<div class="container registration-container admin_submitbox">
    <div class="mdl-card z-depth-0 registration-card mdl-shadow-mobile">
      <div class="mdl-card__title card-title-registration center-align">
        <text class="full-width">Cancel Request</text>
      </div>
      <form name="admin_form" method="post" onsubmit="return validateAssign()" action="../Database/doc_cancel_request.php" >
        <div class="registration-card-actions">
        <p>To cancel a form request enter the id of the form request that you wish to cancel. You can view your current pending form in the table below.</p>
        <br>
        <?php
        switch ($_SESSION['assign_result']) {
                	case "no_exist":
                		echo "<p> The form request does not exist, check the table below. </p>";
                		break;
                	default:
                		# code...
                		break;
                }        
                $_SESSION['assign_result'] = "default";
        ?>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-floating-text registration-text-inputs registration-input-widths registration-right">
            <input class="mdl-textfield__input" type="text" pattern="^[0-9]*$" name="patientid">
            <label class="mdl-textfield__label" for="patientid">Requested Form ID</label>
            <span class="mdl-textfield__error absolute registration-spans" name="pid-incorrect">Numbers Only</span>
            <span class="visibility-false absolute" name="pid-length">Input is too long! >16 </span>
            <span class="visibility-false absolute registration-spans" name="pid-missing">Please enter a ID</span>
          </div>
        </div>
        <div class="registration-card-actions center-align">
          <button class="mdl-button mdl-js-button mdl-button--raised waves-effect waves-light btn-large submit-button submit-margin-bottom" type="submit" name="submit">Cancel Request
          </button>
        </div>
      </form>
    </div>
</div>
  
    <?php 
    $currentdoctorusername = $_SESSION['session_user_name'];
    $getdoctor_idsql = "SELECT Doctor_ID FROM Doctor WHERE Username = '$currentdoctorusername'";
    $doctorid_result = mysqli_query($dbc,$getdoctor_idsql);
    $currentdoctorid = mysqli_fetch_row($doctorid_result);
    $currentrequestedforms_sql ="SELECT * FROM Requested_Forms WHERE Doctor_ID = '$currentdoctorid[0]'";
    $currentrequestedform_result = mysqli_query($dbc,$currentrequestedforms_sql); 
    if (mysqli_num_rows($currentrequestedform_result) == 0) {
      echo "<div class=\"container registration_success_content mdl-card admin_text patientadminbox patient_admin_width\" >
        <p class=\"registration_success_title \" style=\"margin-left: 20px;\">Pending forms</p>
          <table style=\" margin-left: 20px;\">
              <thead>
                <tr>
            <th data-field=\"form_id\">Requested Form ID</th>
            <th data-field=\"paitent_id\">Patient ID</th>
                    <th data-field=\"patient_name\">Patient Name</th>
                    <th data-field=\"form_type\">Form Type</th>
                </tr>
              </thead>
              <tbody>
              <tr>
              <th> No Forms currently pending
              </th>
              </tr>
              </tbody>
              </table>";
    } else {
      echo "<div class=\"container registration_success_content mdl-card admin_text patientadminbox patient_admin_width\" >
        <p class=\"registration_success_title \" style=\"margin-left: 20px;\">Requested forms</p>
          <table style=\" margin-left: 20px;\">
              <thead>
                <tr>
            <th data-field=\"form_id\">Requested Form ID</th>
            <th data-field=\"paitent_id\">Patient ID</th>
                    <th data-field=\"patient_name\">Patient Name</th>
                    <th data-field=\"form_type\">Form Type</th>
                </tr>
              </thead>
              <tbody>";
        $currentrequestedform_result;

        $patient_info_joinsql ="SELECT Patient.Patient_ID,Patient.FName,Patient.SName FROM Requested_Forms INNER JOIN Patient ON Requested_Forms.Patient_ID=Patient.Patient_ID";
        $form_info_joinsql ="SELECT Form_Types.Form_Type FROM Requested_Forms INNER JOIN Form_Types ON Requested_Forms.Form_Type=Form_Types.Form_Type_ID";

          $patient_result = mysqli_query($dbc, $patient_info_joinsql);
          $form_result = mysqli_query($dbc,$form_info_joinsql);
          $numberofloops = mysqli_num_rows($currentrequestedform_result);

          for ($i=0; $i < $numberofloops; $i++) { 
            mysqli_data_seek($patient_result,$i);
          $doctorinfo = mysqli_fetch_row($patient_result);
          mysqli_data_seek($form_result,$i);
          $forminfo = mysqli_fetch_row($form_result);

mysqli_data_seek($currentrequestedform_result,$i);
          $requested_form_info = mysqli_fetch_row($currentrequestedform_result);

          echo "<tr>";
          echo "
          <td>
          $requested_form_info[0]
          </td>
            <td> 
              $doctorinfo[0]
            </td>
            <td> 
              $doctorinfo[1] $doctorinfo[2]
            </td>
          <td> 
          $forminfo[0]
          </td>
          ";
          echo "</tr>";
          }
          
        }
         ?>
        </tbody>
      </table>  
</div>

</body>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/jquery-2.2.1.min.js"></script>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/materialize.min.js"></script>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/material.min.js"></script>
	<script type="text/javascript" src="../Scripts/doctor_homepage.js"></script>
	<script type="text/javascript" src="../Scripts/doc_cancel_request.js"></script>
</html>
