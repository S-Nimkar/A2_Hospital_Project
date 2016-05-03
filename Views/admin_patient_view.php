
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
$tbl_name="Patient"; // Table name


// Connect to server and select databse.
$dbc = mysqli_connect("$host", "$username", "$password")or die("cannot connect");
mysqli_select_db($dbc, $db_name) or die("cannot select DB"); 

$dbase_password_get ="SELECT Password FROM $tbl_name ";
$dbase_username_get ="SELECT Username FROM $tbl_name ";
$dbase_id_get ="SELECT Patient_ID FROM $tbl_name ";
$dbase_fname_get ="SELECT FName FROM $tbl_name ";
$dbase_sname_get ="SELECT SName FROM $tbl_name ";
$dbase_email_get ="SELECT Email_address FROM $tbl_name ";

$dbase_username = mysqli_query($dbc, $dbase_username_get);
$dbase_password = mysqli_query($dbc, $dbase_password_get);
$dbase_id = mysqli_query($dbc, $dbase_id_get);
$dbase_fname = mysqli_query($dbc, $dbase_fname_get);
$dbase_sname = mysqli_query($dbc, $dbase_sname_get);
$dbase_email = mysqli_query($dbc, $dbase_email_get);

$rowcountresult = mysqli_query($dbc, $dbase_id_get);

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
            <li><a href="admin_admin_view.php">View Completed Forms</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </ul>
  <li style="background-color: #669999;"><a href="../Database/logout.php" >Logout</a></li>
  </header>
<body class="registration_success_background">


<div class="container registration_success_content mdl-card admin_text patientadminbox patient_admin_width" >
	<p class="registration_success_title " style="margin-left: 20px;">Patients</p>
	  <table style=" margin-left: 20px;">
        <thead>
          <tr>
              <th data-field="patient_id">PatientsID</th>
              <th data-field="patient_fname">First Name</th>
              <th data-field="patient_sname">Surname</th>
              <th data-field="patient_email">Email Address</th>
              <th data-field="user_name">Username</th>
              <th data-field="pass_word">Password</th>
          </tr>
        </thead>

        <tbody>

        <?php

        $rowcount = mysqli_num_rows($rowcountresult);
        $rowcheck = $rowcount;
        if ($rowcheck = 0){
        	echo "<tr>
        			<td>NO PATIENTS</td>
              </tr>
			";
        }
        $currentrow = 0;

        for ($i=0; $i < $rowcount ; $i++) { 
        	
        	mysqli_data_seek($dbase_id,$currentrow);
        	$currentid = mysqli_fetch_row($dbase_id);

        	mysqli_data_seek($dbase_name,$i);
        	$currentfirstname = mysqli_fetch_row($dbase_fname);

          mysqli_data_seek($dbase_name,$i);
          $currentsurname = mysqli_fetch_row($dbase_sname);

          mysqli_data_seek($dbase_name,$i);
          $currentemail = mysqli_fetch_row($dbase_email);

        	mysqli_data_seek($dbase_skey,$i);
        	$currentskey = mysqli_fetch_row($dbase_skey);

        	mysqli_data_seek($dbase_username,$i);
        	$currentusername = mysqli_fetch_row($dbase_username);

        	mysqli_data_seek($dbase_password,$i);
        	$currentpassword = mysqli_fetch_row($dbase_password);

        	$currentrow = ($currentrow + 1);
        	echo "<tr>";
        	echo "<td style=\"width :20px;\"> 
        			$currentid[0]
        		</td>
            <td> 
              $currentfirstname[0]
            </td>
            <td> 
              $currentsurname[0]
            </td>
        		<td> 
        			$currentemail[0]
        		</td>
        		<td> 
        			$currentusername[0]
        		</td>
        		<td> 
        			$currentpassword[0]
        		</td>
        		<td> 
        			$currentskey[0]
        		</td>

        	";
        	echo "</tr>";
        }
         ?>
        </tbody>
      </table>
            
</div>
	
</body>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/jquery-2.2.1.min.js"></script>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/materialize.min.js"></script>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/material.min.js"></script>
	<script type="text/javascript" src="../Scripts/admin_homepage.js"></script>

</html>
