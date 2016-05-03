<?php 
session_start();
if ($_SESSION['active'] != "3") {
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


$Doctor_id= $_POST['doctorid'];
$Patient_id = $_POST['patientid'];


$doctoridsql ="SELECT Username FROM Doctor WHERE Doctor_ID = '$Doctor_id' ";
$returned_doctoridresult = mysqli_query($dbc,$doctoridsql);

if (mysqli_num_rows($returned_doctoridresult) != 1){
		$_SESSION['assign_result'] = 'nodoctor';
	//noidfound
	header('Location: ../Views/admin_assign_patients.php');
	die;
} else {
	mysqli_data_seek($returned_doctoridresult,0);
	$doctor_username = mysqli_fetch_row($returned_doctoridresult);
	$doctor_tablename = $doctor_username[0];
	$doctor_tablename .= "_table";

}

$checkpatientexists = "SELECT Patient_ID FROM Patient WHERE Patient_ID = '$Patient_id'";
$checkedpatientresult = mysqli_query($dbc,$checkpatientexists);

if (mysqli_num_rows($checkedpatientresult) != 1){
	//noidfound
	$_SESSION['assign_result'] = 'nopatient';
	header('Location: ../Views/admin_assign_patients.php');
	die;
}
//checking if the id already exists in the table we want to add to

$checkpatientexists_indtable = "SELECT ReferenceID FROM $doctor_tablename WHERE ReferenceID = '$Patient_id'";

$checkedpatientexists_in_dtable_result = mysqli_query($dbc,$checkpatientexists_indtable);
if (mysqli_num_rows($checkedpatientexists_in_dtable_result) != 0) {
	//id exists already
	$_SESSION['assign_result'] = 'already_exits';
		header('Location: ../Views/admin_assign_patients.php');
	die;
}
$insertpatientsql ="INSERT INTO $doctor_tablename (ReferenceID) Values ('$Patient_id')";

if (mysqli_query($dbc,$insertpatientsql)){
	header('Location: ../Views/admin_assigned_patients_view2.php');
}



?>