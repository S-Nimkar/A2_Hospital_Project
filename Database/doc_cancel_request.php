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


$reference_id = $_POST['patientid'];
$doctor_username = $_SESSION['session_user_name'];
$doctorgetid_sql = "SELECT Doctor_ID FROM Doctor WHERE Username ='$doctor_username'";
$doctoridresult = mysqli_query($dbc,$doctorgetid_sql);
$doctorid = mysqli_fetch_row($doctoridresult);
$getdoctor_references_sql = "SELECT Requested_Form_ID FROM Requested_Forms WHERE Doctor_ID = '$doctorid[0]' AND Requested_Form_ID = '$reference_id'";
$doctor_reference_result = mysqli_query($dbc,$getdoctor_references_sql);
if (mysqli_num_rows($doctor_reference_result) == 1) {
	$deletefromreference_sql = "DELETE FROM Requested_Forms WHERE Requested_Form_ID = '$reference_id'";
	mysqli_query($dbc,$deletefromreference_sql);
	header('Location: ../Views/doctor_homepage.php');
} else{
	$_SESSION['assign_result'] = 'no_exist';
	header('Location: ../Views/doctor_cancel_request.php');
}

?>