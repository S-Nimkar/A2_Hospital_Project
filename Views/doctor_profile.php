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
$tbl_name="Patient"; // Table name


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
		<li><a href="doctor_my_patients.php">My Patients</a></li>
	</ul>
  <li style="background-color: #669999;" ><a href="../Database/logout.php" >Logout</a></li>
</div>
</header>
<body class="registration_success_background">
<div class="container registration_success_content mdl-card admin_text patientadminbox patient_admin_width" >
	<p class="registration_success_title " style="margin-left: 20px;">My Profile Information</p>
	  <table style=" margin-left: 20px;">
        <thead>
          <tr>
              <th data-field="patient_fname">Name</th>
              <th data-field="patient_sname">Username</th>
              <th data-field="patient_email">Password</th>
              <th data-field="user_name">Security Key</th>
          </tr>
        </thead>

        <tbody>

        <?php
        	$doctor_username = $_SESSION['session_user_name'];
        	$getdoctorinfo_sql = "SELECT * FROM Doctor WHERE Username = '$doctor_username'";
        	$doctor_result = mysqli_query($dbc, $getdoctorinfo_sql);
        	$doctorinfo = mysqli_fetch_row($doctor_result);
        	echo "<tr>";
        	echo "
            <td> 
              $doctorinfo[1]
            </td>
            <td> 
              $doctorinfo[2]
            </td>
        	<td> 
        		$doctorinfo[3]
        	</td>
        	<td> 
        		$doctorinfo[4]
        	</td>
        	";
        	echo "</tr>";
         ?>
        </tbody>
      </table>  
</div>

</body>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/jquery-2.2.1.min.js"></script>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/materialize.min.js"></script>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/material.min.js"></script>
	<script type="text/javascript" src="../Scripts/doctor_homepage.js"></script>
</html>
