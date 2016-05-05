<?php 
session_start();
if ($_SESSION['active'] != "5" or $_SESSION['loadedform'] != "true") {
	header('Location: ../Views/doctor_completed_forms.php');
  $_SESSION['assign_result'] = 'ended'; 
	die;
	//forward to server generic error access
}
$_SESSION['loadedform'] = 'default';
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
            <li><a href="doctor_completed_forms.php">My Completed Forms</a></li>
            <li><a href="doctor_request_form.php">Request Form</a></li>
            <li><a href="doctor_cancel_request.php">Cancel Request</a></li>
            <li><a href="doctor_pending_forms">Pending Forms</a></li>
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
            <li><a href="doctor_unassign_patient.php">Unassign Patient</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </ul>
  <li style="background-color: #669999;" ><a href="../Database/logout.php" >Logout</a></li>
</div>
</header>
<body class="registration_success_background">
	<div class="container registration-container admin_submitbox">
    <div class="mdl-card z-depth-0 registration-card mdl-shadow-mobile">
      <div class="mdl-card__title card-title-registration center-align">
        <text class="full-width"> <?php echo $_SESSION['Patients_Name']."'s ".$_SESSION['Form_Type']." Form"; ?></text>
        </div>
        <br>
        <p class="light  registration_success_textmargins " style="font-size: 3rem;">Patient Information</p>
        <br>
       <p class="light  registration_success_textmargins " style="font-size: 1rem;">First Name:  <?php echo $_SESSION['Patient_Information'][Fname];?> </p>
       <p class="light  registration_success_textmargins " style="font-size: 1rem;">Surname:  <?php echo $_SESSION['Patient_Information'][Sname];?></p>

       <p class="light  registration_success_textmargins " style="font-size: 1rem;">Age:  <?php echo $_SESSION['Patient_Information'][Age];?> </p>
       <p class="light  registration_success_textmargins " style="font-size: 1rem;">Date of Birth:   <?php echo $_SESSION['Patient_Information'][DOB];?> </p>
       <br>
       <p class="light  registration_success_textmargins "style="font-size: 2rem;">Contact Information</p>
       <p class="light  registration_success_textmargins " style="font-size: 1rem;">Home Number:  <?php echo $_SESSION['Patient_Information'][Hnum];?>  </p>
       <p class="light  registration_success_textmargins " style="font-size: 1rem;">Mobile Number:   <?php echo $_SESSION['Patient_Information'][Mnum];?> </p>
       <p class="light  registration_success_textmargins " style="font-size: 1rem;">Email Address:  <?php echo $_SESSION['Patient_Information'][Email];?></p>

       <p class="light  registration_success_textmargins " style="font-size: 1rem;">Postcode:   <?php echo $_SESSION['Patient_Information'][Postcode];?> </p>
       <br>
       <p class="light  registration_success_textmargins " style="font-size: 2rem;">Medical information:</p>
       <p class="light  registration_success_textmargins " style="font-size: 1rem;">Allergies: </p>
          <p class="light  registration_success_textmargins " style="font-size: 1rem;"><?php echo  $_SESSION['Patient_Information'][Allergies];?> </p>            
       <p class="light  registration_success_textmargins " style="font-size: 1rem;">Past Conditions: </p>
<p class="light  registration_success_textmargins " style="font-size: 1rem;"><?php echo $_SESSION['Patient_Information'][Past_Conditions];?> </p>
       <p class="light  registration_success_textmargins " style="font-size: 1rem;">Extra Information: </p>
<p class="light  registration_success_textmargins " style="font-size: 1rem;"><?php echo  $_SESSION['Patient_Information'][Extra_Info];?> </p>
   
 
    </div>
    </div>
  </body>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/jquery-2.2.1.min.js"></script>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/materialize.min.js"></script>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/material.min.js"></script>
	<script type="text/javascript" src="../Scripts/doctor_homepage.js"></script>
</html>
