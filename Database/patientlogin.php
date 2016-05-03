<?php 
session_start();
if ($_SESSION['active'] != "1") {
	header('Location: ../Views/server_error.html');
	die;
	//forward to server generic error access
}
$_SESSION['active'] = '4';
$host="localhost"; // Host name
$username="root"; // Mysql username
$password="root"; // Mysql password
$db_name="Hospital_Database"; // Database name
$tbl_name="Patient"; // Table name


// Connect to server and select databse.
$dbc = mysqli_connect("$host", "$username", "$password")or die("cannot connect");
mysqli_select_db($dbc, $db_name) or die("cannot select DB"); 


$patient_username = $_SESSION['session_user_name'];
$patient_password = $_SESSION['session_pass_word'];

$patient_login ="SELECT Username, Password FROM $tbl_name WHERE Username = '$patient_username' ";

$dbase_password_get ="SELECT Password FROM $tbl_name WHERE Username = '$patient_username' ";
$dbase_username_get ="SELECT Username FROM $tbl_name WHERE Username = '$patient_username'";

$checked_patient_login = mysqli_query($dbc, $patient_login);

$dbase_username = mysqli_query($dbc, $dbase_username_get);
$dbase_password = mysqli_query($dbc, $dbase_password_get);

mysqli_data_seek($dbase_username,0);
$db_username = mysqli_fetch_row($dbase_username);

mysqli_data_seek($dbase_password,0);
$db_password = mysqli_fetch_row($dbase_password);

if (mysqli_num_rows($checked_patient_login) == 0){
      //add login failure
   header('Location: ../Views/loginfailure.html');
}else {
	if ($patient_username == $db_username[0] and $patient_password == $db_password[0]){
		//patient home page
		$patietnusername = $db_username[0];
		$getpatientnamesql = "SELECT FName,SName,Patient_ID FROM Patient WHERE Username ='$patietnusername' ";
		$nameresult = mysqli_query($dbc,$getpatientnamesql);
		$patientnamevals = mysqli_fetch_row($nameresult);
		$pname .= $patientnamevals[0];
		$pname .= " ";
		$pname .= $patientnamevals[1];
		$id .=  $patientnamevals[2];
		$_SESSION['patientid'] = $id;
		$_SESSION['patientname'] = $pname;
   header('Location: ../Views/patient_homepage.php');
	} else {
		header('Location: ../Views/loginfailure.html');
	}
}


?>