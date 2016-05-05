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
		$checkpatientrequest_sql = "SELECT Patient_ID FROM Requested_Forms WHERE Patient_ID = '$patientid'";
		$patitntrequest_result = mysqli_query($dbc,$checkpatientrequest_sql);
		if (mysqli_num_rows($patitntrequest_result) == 0) {
			echo "<div class=\"container registration_success_content mdl-card admin_text patientadminbox patient_admin_width\" >
				<p class=\"registration_success_title \" style=\"margin-left: 20px;\">Pending forms</p>
				  <table style=\" margin-left: 20px;\">
			        <thead>
			          <tr>
						<th data-field=\"form_id\">Form ID</th>
						<th data-field=\"doctor\">Doctor</th>
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
						<th data-field=\"form_id\">Form ID</th>
						<th data-field=\"doctor\">Doctor</th>
			            <th data-field=\"form_type\">Form Type</th>
			          </tr>
			        </thead>
			        <tbody>";
			$numberofloops = mysqli_num_rows($patitntrequest_result);

    		$doctor_info_joinsql ="SELECT Doctor.Name FROM Requested_Forms INNER JOIN Doctor ON Requested_Forms.Doctor_ID=Doctor.Doctor_ID WHERE Patient_ID = '$patientid'";
    		$form_info_joinsql ="SELECT Form_Types.Form_Type FROM Requested_Forms INNER JOIN Form_Types ON Requested_Forms.Form_Type=Form_Types.Form_Type_ID WHERE Patient_ID = '$patientid'";
    		$getrequestid_sql = "SELECT Requested_Form_ID FROM Requested_Forms WHERE Patient_ID = '$patientid'";

        	$patient_result = mysqli_query($dbc, $doctor_info_joinsql);
        	$form_result = mysqli_query($dbc,$form_info_joinsql);
        	$requestid_result = mysqli_query($dbc,$getrequestid_sql);

        	for ($i=0; $i < $numberofloops; $i++) { 
        	mysqli_data_seek($patient_result,$i);
        	$doctorinfo = mysqli_fetch_row($patient_result);
        	mysqli_data_seek($form_result,$i);
        	$forminfo = mysqli_fetch_row($form_result);
        	mysqli_data_seek($requestid_result,$i);
        	$requestinfo = mysqli_fetch_row($requestid_result);

        	echo "<tr>";
        	echo "
        	<td>
        	$requestinfo[0]
        	</td>
            <td> 
            $doctorinfo[0]
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
</body>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/jquery-2.2.1.min.js"></script>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/materialize.min.js"></script>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/material.min.js"></script>
	<script type="text/javascript" src="../Scripts/patient_homepage.js"></script>
</html>
