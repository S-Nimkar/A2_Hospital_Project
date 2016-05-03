<?php 
session_start();
if ($_SESSION['active'] != "4") {
	header('Location: ../Views/server_error.html');
	die;
	//forward to server generic error access
}
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
			<a href="patient_homepage.php" class="sidenavbrand-logo brand-logo center-align tooltipped nav-bar-logo" data-position="right" data-delay="50" data-tooltip="Nimkar Medical Practitioners" >NMP
			</a>
			<a href="#" data-activates="nav-mobile" class="button-collapse top-nav full hide-on-large-only" style="margin-left: 30px;">
				<i class="material-icons">menu</i>
			</a>
		</div>
	</nav>
	<ul id="nav-mobile" class="side-nav fixed" style="transform: translateX(0%);">
		<ul>
			<li class ="logo"><a href="patient_homepage.php" class="sidenav-brandlogo center-align nav-bar-logo " data-position="right" data-delay="50" style=" font-size: 5rem;">NMP
			</a>
		</li>
		<li><a href="patient_profile.php">My Profile</a></li>
		<ul class="collapsible collapsible-accordion">
			<li>
				<a class="collapsible-header">Forms</a>
				<div class="collapsible-body">
					<ul>
						<li><a href="">My Completed Forms</a></li>
						<li><a href="">Pending Forms</a></li>
					</ul>
				</div>
			</li>
		</ul>
		<li><a href="patient_doctors.php">My Doctors</a></li>
	</ul>
	<li><a href="../Database/logout.php" style="background-color: #669999;">Logout</a></li>
</ul>
</div>
</header>
<body class="registration_success_background">
	<div class="container registration_success_content mdl-card admin_text " >
		<p class="registration_success_title " style="margin-left: 20px;"><?php echo"Welcome ". $_SESSION['patientname'].""; ?> </p>
		<p class="light  registration_success_textmargins ">This page will allow you to edit the doctors, patients and admins. You can also view the forms of patients that have been submited to the system</p>
		<p class="light registration_success_textmargins">Navigate to the pages via the side-nav on the left</p>
	</div>
</body>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/jquery-2.2.1.min.js"></script>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/materialize.min.js"></script>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/material.min.js"></script>
	<script type="text/javascript" src="../Scripts/patient_homepage.js"></script>
</html>
