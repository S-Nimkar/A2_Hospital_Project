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

$Patient_id = $_POST['patientid'];
$doctor_tablename = $_SESSION['session_user_name'];
$doctor_tablename .= "_table";


$checkpatientexists = "SELECT Patient_ID FROM Patient WHERE Patient_ID = '$Patient_id'";
$checkedpatientresult = mysqli_query($dbc,$checkpatientexists);

if (mysqli_num_rows($checkedpatientresult) != 1){
	//noidfound
	$_SESSION['assign_result'] = 'nopatient';
	header('Location: ../Views/doctor_unassign_patient.php');
	die;
}
//checking if the id already exists in the table we want to add to

$checkpatientexists_indtable = "SELECT ReferenceID FROM $doctor_tablename WHERE ReferenceID = '$Patient_id'";

$checkedpatientexists_in_dtable_result = mysqli_query($dbc,$checkpatientexists_indtable);
if (mysqli_num_rows($checkedpatientexists_in_dtable_result) == 1) {
	//id exists
		$removepatient_sql = "DELETE FROM $doctor_tablename WHERE ReferenceID = '$Patient_id' ";
		if(mysqli_query($dbc,$removepatient_sql)){
		header('Location: ../Views/doctor_my_patients.php');
		}
}else{
	$_SESSION['assign_result'] = 'nopatientfound';
	header('Location: ../Views/doctor_unassign_patient.php');
}



?>