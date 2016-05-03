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
                        </ul>
                      </div>
                    </li>
                  </ul>
                  <ul class="collapsible collapsible-accordion">
                    <li>
                      <a class="collapsible-header">Forms</a>
                      <div class="collapsible-body">
                          <ul>
                            <li><a href="admin_admin_view.php">View Forms</a></li>
                        </ul>
                      </div>
                    </li>
                  </ul>
            </ul>
      </ul>
  </div>

</header>
<body class="registration_success_background">
    <div class="container registration_success_content mdl-card admin_text patient_admin_width patientadminbox" >
      <form name="admin_form" method="post" onsubmit="return validateGetPatientID()" action="../Database/get_patient.php" >
        <div class="registration-card-actions">
        <p>To edit a patient please enter the patient ID into the text field below </p>
        <?php
        if ($_SESSION['patientidget'] == "fail"){
          echo "
          <br>
          <p>Patient does not exist</p>";
        }
        $_SESSION['patientget'] = 'default'
        ?>
        <br>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-floating-text registration-text-inputs registration-input-widths registration-right">
            <input class="mdl-textfield__input" type="text" pattern="^[0-9]*$" name="patientid">
            <label class="mdl-textfield__label" for="id">Patient ID</label>
            <span class="mdl-textfield__error absolute registration-spans" name="id-incorrect">Numbers Only</span>
            <span class="visibility-false absolute" name="id-length">Input is too long! >16 </span>
            <span class="visibility-false absolute registration-spans" name="id-missing">Please enter a ID</span>
          </div>
        </div>
        <div class="registration-card-actions center-align">
          <button class="mdl-button mdl-js-button mdl-button--raised waves-effect waves-light btn-large submit-button submit-margin-bottom" type="submit" name="submit">Get Patient
          </button>

        </div>
      </form>
      </div>
</body>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/jquery-2.2.1.min.js"></script>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/materialize.min.js"></script>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/material.min.js"></script>
	<script type="text/javascript" src="../Scripts/admin_homepage.js"></script>
  <script type="text/javascript" src="../Scripts/editpatient_get.js"></script>

</html>
