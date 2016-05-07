<?php
session_start();
if ($_SESSION['active'] != "3") {
	header('Location: ../Views/server_error.html');
	die;
}
$_SESSION['removal'] = 'true';
$host="localhost"; // Host name
$username="root"; // Mysql username
$password="root"; // Mysql password
$db_name="Hospital_Database"; // Database name
$tbl_name= "Patient"; // Table name


// Connect to server and select databse.
$dbc = mysqli_connect("$host", "$username", "$password")or die("cannot connect");
mysqli_select_db($dbc, $db_name) or die("cannot select DB"); 

$patientid = $_POST['id'];

$idchecksql ="SELECT Patient_ID FROM $tbl_name WHERE Patient_ID = '$patientid' ";

$delete_from_patient_table ="DELETE FROM Patient WHERE Patient_ID ='$patientid'";

$checked_id = mysqli_query($dbc, $idchecksql);

if (mysqli_num_rows($checked_id) == 1 ){

  if(mysqli_query($dbc, $delete_from_patient_table)){
	header('Location: ../Views/admin_patient_view.php');
} else {
	$_SESSION['removal'] = 'restrict';
	header('Location: ../Views/admin_remove_patient.php');
}

} else {
  //noworking
  $_SESSION['removal'] = 'fail';
  header('Location: ../Views/admin_remove_patient.php');
}


?>