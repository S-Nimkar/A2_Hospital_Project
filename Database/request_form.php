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


$patient_id = $_POST['patientid'];
$form_type = $_POST['formtype'];
$doctor_tablename = $_SESSION['session_user_name'];
$doctor_tablename .= "_table";

$checkpatientexists_indtable = "SELECT ReferenceID FROM $doctor_tablename WHERE ReferenceID = '$patient_id'";

$checkedpatientexists_in_dtable_result = mysqli_query($dbc,$checkpatientexists_indtable);
if (mysqli_num_rows($checkedpatientexists_in_dtable_result) == 0) {
	//id does not exist
	$_SESSION['assign_result'] = 'no_exist';
		header('Location: ../Views/doctor_request_form.php');
	die;
}

$get_formtype_id = "SELECT Form_Type_ID FROM Form_Types WHERE Form_Type = '$form_type'";
$formtype_result = mysqli_query($dbc,$get_formtype_id);
$currentformtype = mysqli_fetch_row($formtype_result);
$currentdoctorusername = $_SESSION['session_user_name'];
$getdoctor_idsql = "SELECT Doctor_ID FROM Doctor WHERE Username = '$currentdoctorusername'";
$doctorid_result = mysqli_query($dbc,$getdoctor_idsql);
$currentdoctorid = mysqli_fetch_row($doctorid_result);
$insertrequest_sql = "INSERT INTO Requested_Forms(Patient_ID,Doctor_ID,Form_Type) VALUES ($patient_id,$currentdoctorid[0],$currentformtype[0])";
mysqli_query($dbc,$insertrequest_sql);
header('Location: ../Views/doctor_homepage.php');

?>