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

$patientid= $_POST['patientid'];

$checkpatientidsql = "SELECT Patient_ID FROM $tbl_name WHERE Patient_ID = '$patientid'";
$patientidsql = "SELECT * FROM $tbl_name WHERE Patient_ID = '$patientid'";

if (mysqli_num_rows(mysqli_query($dbc, $checkpatientidsql)) != 1){
	$_SESSION['patientidget'] = 'fail';
	header('Location: ../Views/admin_edit_patient.php');
	die;
} else{
	$patientresult = mysqli_query($dbc, $patientidsql);
	$_SESSION['patientinfo'] = mysqli_fetch_row($patientresult);
	header('Location: ../Views/admin_got_patient.php');
	die;
}



?>