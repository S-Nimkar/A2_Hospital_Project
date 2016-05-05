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

<?php
        $completed_forms_sql ="SELECT * FROM Completed_Forms";
        $rowcountresult = mysqli_query($dbc,$completed_forms_sql);

        $rowcount = mysqli_num_rows($rowcountresult);
        $rowcheck = $rowcount;

        if ($rowcheck == 0){
        	echo "
          <div class=\"container registration_success_content mdl-card admin_text patient_admin_width\" >
              <p class=\"registration_success_title \" style=\"margin-left: 20px;\">No Completed Forms Found</p>
               <table style=\" margin-left: 20px;\">
                 <thead>
                <tr>
              <th data-field=\"Form_request_id\">Completed Forms ID</th>
              <th data-field=\"user_name\">Patient ID</th>
              <th data-field=\"first_name\">Doctor ID</th>
              <th data-field=\"surname\">Details ID</th>
              </tr>
        </thead>
        <tbody>
          <tr>
        		<td>No Current Form Requests.</td>
          </tr>
        </tbody>
        </table>
        </div>
			   ";
        } else {
          echo "
          <div class=\"container registration_success_content mdl-card admin_text patient_admin_width\" >
              <p class=\"registration_success_title \" style=\"margin-left: 20px;\">Completed Forms</p>
               <table style=\" margin-left: 20px;\">
                 <thead>
                <tr>
              <th data-field=\"Form_request_id\">Completed Forms ID</th>
              <th data-field=\"user_name\">Patient ID</th>
              <th data-field=\"first_name\">Doctor ID</th>
              <th data-field=\"surname\">Details ID</th>
              </tr>
        </thead>

        <tbody>";
        for ($i=0; $i < $rowcheck; $i++) { 
          mysqli_data_seek($rowcountresult,$i);
          $current_row = mysqli_fetch_row($rowcountresult);
          echo "<tr><td>".$current_row[0]."</td><td>".$current_row[1]."</td><td>".$current_row[2]."</td><td>".$current_row[3]."</td></tr>";
        }
          echo"
        </tbody>
        </table>
        </div>
         ";

        }

      	$completed_forms_sql2 ="SELECT * FROM Form_Details";
        $rowcountresult2 = mysqli_query($dbc,$completed_forms_sql2);

        $rowcount2 = mysqli_num_rows($rowcountresult2);
        $rowcheck2 = $rowcount2;

        if ($rowcheck2 == 0){
        	echo "
          <div class=\"container registration_success_content mdl-card admin_text patient_admin_width\" >
              <p class=\"registration_success_title \" style=\"margin-left: 20px;\">No Form Details Found</p>
               <table style=\" margin-left: 20px;\">
                 <thead>
                <tr>
              <th data-field=\"Form_request_id\">Form Details ID</th>
              <th data-field=\"user_name\">Info ID</th>
              <th data-field=\"surname\">Form Type</th>
              </tr>
        </thead>
        <tbody>
          <tr>
        		<td>No Current Form Requests.</td>
          </tr>
        </tbody>
        </table>
        </div>
			   ";
        } else {
          echo "
          <div class=\"container registration_success_content mdl-card admin_text patient_admin_width\" >
              <p class=\"registration_success_title \" style=\"margin-left: 20px;\">Form Details</p>
               <table style=\" margin-left: 20px;\">
                 <thead>
                <tr>
              <th data-field=\"Form_request_id\">Form Details ID</th>
              <th data-field=\"user_name\">Info ID</th>
              <th data-field=\"surname\">Form Type</th>
              </tr>
        </thead>
        <tbody>";
        for ($i2=0; $i2 < $rowcheck2; $i2++) { 
          mysqli_data_seek($rowcountresult2,$i2);
          $current_row2 = mysqli_fetch_row($rowcountresult2);
          echo "<tr><td>".$current_row2[0]."</td><td>".$current_row2[1]."</td><td>".$current_row2[2]."</td></tr>";
        }
          echo"
        </tbody>
		</table>
        </div>
         ";
     }
      ?>
</body>
<script type="text/javascript" src="../Scripts/Minified-Scripts/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="../Scripts/Minified-Scripts/materialize.min.js"></script>
<script type="text/javascript" src="../Scripts/Minified-Scripts/material.min.js"></script>
<script type="text/javascript" src="../Scripts/admin_homepage.js"></script>
</html>
