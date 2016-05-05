<?php 
session_start();
if ($_SESSION['active'] != "4" and $_SESSION['requestpage'] != "true") {
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
$currentdoctorsid = $_SESSION['current_form_doctorid'];
$get_doctors_name_sql = "SELECT Name FROM Doctor WHERE Doctor_ID = '$currentdoctorsid'";
$currentformid = $_SESSION['current_form_typeid'];
$get_form_name_sql = "SELECT Form_Type FROM Form_Types WHERE Form_Type_ID = '$currentformid'";

$doctorsname_result = mysqli_query($dbc,$get_doctors_name_sql);
$formname_result = mysqli_query($dbc,$get_form_name_sql);
$doctors_name = mysqli_fetch_row($doctorsname_result);
$form_name = mysqli_fetch_row($formname_result);
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
	<li style="background-color: #669999;"><a href="../Database/logout.php" >Logout</a></li>
</ul>
</div>
</header>
<body class="registration_success_background">
<div class="container registration-container admin_submitbox">
    <div class="mdl-card z-depth-0 registration-card mdl-shadow-mobile">
      <div class="mdl-card__title card-title-registration center-align" style="margin-top:10px;">
        <text class="full-width"><?php echo $form_name[0]." Form.  Requested by Doctor ".$doctors_name[0];?></text>
      </div>
        <div class="registration-card-actions">
        <form name="report_form" method="post" onsubmit="return validateForm()" action="../Database/patient_form_populate.php" >
				<div class="registration-card-actions">
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-floating-text registration-text-inputs registration-input-widths registration-right">
						<input class="mdl-textfield__input" type="text" pattern="^(0?[1-9]|[1-9][0-9])$" name="age">
						<label class="mdl-textfield__label" for="age">Age</label>
						<span class="mdl-textfield__error  registration-spans" name="age-incorrect">Please enter a valid Age, 1 - 99 only accepted.</span>
						<span class="visibility-false absolute " name="age-missing">Please enter an Age </span>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-floating-text registration-text-inputs registration-input-widths registration-right">
						<input class="mdl-textfield__input" type="text" pattern="(^(((0[1-9]|1[0-9]|2[0-8])[\/](0[1-9]|1[012]))|((29|30|31)[\/](0[13578]|1[02]))|((29|30)[\/](0[4,6,9]|11)))[\/](19|[2-9][0-9])\d\d$)|(^29[\/]02[\/](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)" name="date_of_birth">
						<label class="mdl-textfield__label" for="date_of_birth">Date of birth</label>
						<span class="mdl-textfield__error absolute registration-spans" name="date_of_birth-incorrect">Years from 1900 to 9999 are valid. Only DD/MM/YYYY</span>
						<span class=" visibility-false absolute " name="date_of_birth-missing">Please enter a Date of birth</span>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-floating-text registration-text-inputs registration-input-widths registration-right">
						<input class="mdl-textfield__input" type="text" pattern="^[0-9]*$" name="home_number">
						<label class="mdl-textfield__label" for="home_number">Home Number</label>
						<span class="mdl-textfield__error absolute registration-spans" name="home_number-incorrect">Numbers only</span>
						<span class="visibility-false absolute" name="home_number-length">Input is too long! >14 </span>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-floating-text registration-text-inputs registration-input-widths registration-right">
						<input class="mdl-textfield__input" type="text" pattern="^[0-9]*$" name="mobile_number">
						<label class="mdl-textfield__label" for="mobile_number">Mobile Number</label>
						<span class="mdl-textfield__error absolute registration-spans" name="mobile_number-incorrect">Numbers only</span>
						<span class="visibility-false absolute" name="mobile_number-length">Input is too long! >14 </span>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-floating-text registration-text-inputs registration-input-widths registration-right">
						<input class="mdl-textfield__input" type="text" pattern="^[0-9]*$" name="postcode">
						<label class="mdl-textfield__label" for="postcode">Postcode</label>
						<span class="mdl-textfield__error absolute registration-spans" name="postcode-incorrect">Numbers only</span>
						<span class="visibility-false absolute" name="postcode-length">Please input between 6 and 12 numbers, your home postcode. </span>
						<br>
					</div>

					<p> Any allergies that your doctor may need to know should be input below, this is vital as certain medicines can contain chemicals that may trigger existing allergies.</p>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-floating-text registration-text-inputs registration-input-widths registration-right" style="width: 90%;">
					   <div class="row">
						      <div class="row">
						        <div class="input-field col s12">
						          <textarea id="allergies" class="materialize-textarea" type="text" name="allergies"></textarea>
						          <label for="allergies">Allergies</label>
						        </div>
						      </div>
						  </div>
						<span class=" visibility-false relative" name="allergies-length">Input is too long! >500 </span>
					</div>
					<p> Any past conditions that your doctor may need to know should be input below.</p>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-floating-text registration-text-inputs registration-input-widths registration-right" style="width: 90%;">
						 <div class="row">
						      <div class="row">
						        <div class="input-field col s12">
						          <textarea id="past_condtions" class="materialize-textarea" type="text" name="past_conditions"></textarea>
						          <label for="past_condtions">Previous Conditions</label>
						        </div>
						      </div>
						  </div>
						<span class="visibility-false relative" name="past_conditions-length">Input is too long! >1250</span>
					</div>
					<p> Below you should input any extra information pertaining to the medical form.</p>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-floating-text registration-text-inputs registration-input-widths registration-right" style="width: 90%;">
						<div class="row">
						      <div class="row">
						        <div class="input-field col s12">
						          <textarea id="extra_info" class="materialize-textarea" type="text" name="extra_info"></textarea>
						          <label for="extra_info">Extra Information</label>
						        </div>
						      </div>
						  </div>
						<span class=" visibility-false relative" name="extra_info-length">Input is too long! >5000</span>
					</div>
				</div>
				<div class="registration-card-actions center-align">
					<button class="mdl-button mdl-js-button mdl-button--raised waves-effect waves-light btn-large submit-button submit-margin-bottom" type="submit" name="submit">Submit Form
					</button>

				</div>
			</form>
    </div>
 </div>

</body>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/jquery-2.2.1.min.js"></script>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/materialize.min.js"></script>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/material.min.js"></script>
	<script type="text/javascript" src="../Scripts/patient_homepage.js"></script>
	<script type="text/javascript" src="../Scripts/patient_form_validate.js"></script>
</html>
