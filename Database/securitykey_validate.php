<?php
session_start();
if ($_SESSION['active'] != "2") {
	header('Location: ../Views/server_error.html');
	die;
}

$host="localhost"; // Host name
$username="root"; // Mysql username
$password="root"; // Mysql password
$db_name="Hospital_Database"; // Database name
$tbl_name= $_SESSION['TableName']; // Table name


// Connect to server and select databse.
$dbc = mysqli_connect("$host", "$username", "$password")or die("cannot connect");
mysqli_select_db($dbc, $db_name) or die("cannot select DB"); 



$securitykey =$_POST['securitykey'];
$id = $_SESSION['ID'];

$securitychecksql = "SELECT SecurityKey FROM $tbl_name WHERE ".$_SESSION['securitykeyid']." = '$id[0]' ";

$check_security_key = mysqli_query($dbc, $securitychecksql);

mysqli_data_seek($check_security_key,0);
$result = mysqli_fetch_row($check_security_key);

	if ($result[0] == $securitykey){ 
		if ($_SESSION['securitykeyid'] == 'Doctor_ID') {
			$_SESSION['active'] = '5';
			header('Location: ../Views/doctor_homepage.php');
		} else {
			$_SESSION['active'] = '3';
			header('Location: ../Views/admin_homepage.php');
		}
   
	} else {
		header('Location: ../Views/loginfailure.html');
	}



?>