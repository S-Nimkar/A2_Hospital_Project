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
$currentformid = $_POST['requested_form'];

$getform_meta_data_sql = "SELECT * FROM Requested_Forms WHERE Requested_Form_ID = '$currentformid'";
$request_form_meta_data = mysqli_query($dbc,$getform_meta_data_sql);
if (mysqli_num_rows($request_form_meta_data) != 1) {
	$_SESSION['assign_result'] = 'no_exist';
	header('Location: ../Views/patient_request_form.php');
	die;
} else {
	$form_meta_data = mysqli_fetch_row($request_form_meta_data);
	$_SESSION['current_form_patientid'] = $form_meta_data[1];
	$_SESSION['current_form_doctorid'] = $form_meta_data[2];
	$_SESSION['current_form_typeid'] = $form_meta_data[3];
	$_SESSION['current_requested_form'] = $currentformid;
	$_SESSION['requestpage'] = 'true';
	header('Location: ../Views/patient_form_fill.php');
}
?>