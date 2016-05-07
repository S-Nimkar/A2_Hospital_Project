<?php 
session_start();
if ($_SESSION['active'] != "4") {
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
						<li><a href="patient_my_completed_forms.php">My Completed Forms</a></li>
						<li><a href="patient_pending_forms.php">Pending Forms</a></li>
						<li><a href="patient_request_form.php">Submit Form</a></li>
					</ul>
				</div>
			</li>
		</ul>
		<li><a href="patient_doctors.php">My Doctors</a></li>
	</ul>
	<li style="background-color: #669999;"><a href="../Database/logout.php" >Logout</a></li>
</ul>
</div>
</header>
<body class="registration_success_background">
        <?php
        $patientid = $_SESSION['patientid'];
        $getmyforms_sql = "SELECT * FROM Completed_Forms WHERE Patient_ID = '$patientid'";
        $completedforms_result = mysqli_query($dbc,$getmyforms_sql);
        $numberofcompletedforms = mysqli_num_rows($completedforms_result);
        if ($numberofcompletedforms != 0) {
        	echo "<div class=\"container registration_success_content mdl-card admin_text patientadminbox patient_admin_width\" >
				<p class=\"registration_success_title \" style=\"margin-left: 20px;\">My Completed Forms</p>
				  <table style=\" margin-left: 20px;\">
			        <thead>
			          <tr><th data-field=\"form_id\">Compeleted Form ID</th>
						<th data-field=\"doctor\">Doctor</th>
			            <th data-field=\"form_type\">Form Type</th></tr>
			        </thead>
			        <tbody>";
        	for ($i=0; $i < $numberofcompletedforms ; $i++) { 
        		mysqli_data_seek($completedforms_result,$i);
        		$currentcompeltedform_rowset = mysqli_fetch_row($completedforms_result);
        		$curredntformid = $currentcompeltedform_rowset[0];
        		$curredntdoctorid = $currentcompeltedform_rowset[2];
        		$curredntdetailsid = $currentcompeltedform_rowset[3];
        		$getdoctorsname_sql = "SELECT Name FROM Doctor WHERE Doctor_ID = '$curredntdoctorid'";
        		$getformtypeid_sql = "SELECT Form_Type_ID FROM Form_Details WHERE Form_Details_ID = '$curredntdetailsid'";
        		$formtype_id = mysqli_fetch_row(mysqli_query($dbc,$getformtypeid_sql));
				$getformname_sql = "SELECT Form_Type FROM Form_Types Where Form_Type_ID = '$formtype_id[0]'";
				$formtype_name = mysqli_fetch_row(mysqli_query($dbc,$getformname_sql));
        		$doctorsname = mysqli_fetch_row(mysqli_query($dbc,$getdoctorsname_sql));
        		echo "<tr><td>$curredntformid</td><td>$doctorsname[0]</td><td>$formtype_name[0]</td>";
        	}
        	echo "</tbody></table>";
        } else {
        	echo "<div class=\"container registration_success_content mdl-card admin_text patientadminbox patient_admin_width\" >
				<p class=\"registration_success_title \" style=\"margin-left: 20px;\">No Forms Compelted Yet</p>";
        }
        ?>
</body>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/jquery-2.2.1.min.js"></script>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/materialize.min.js"></script>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/material.min.js"></script>
	<script type="text/javascript" src="../Scripts/patient_homepage.js"></script>
</html>
