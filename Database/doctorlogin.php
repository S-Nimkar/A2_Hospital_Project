<?php 
session_start();
if ($_SESSION['active'] != "1") {
	header('Location: ../Views/server_error.html');
	die;
	//forward to server generic error access
}
$_SESSION['active'] = '2';
$_SESSION['securitykeyid'] = 'Doctor_ID'; 
$_SESSION['TableName'] = 'Doctor';
$host="localhost"; // Host name
$username="root"; // Mysql username
$password="root"; // Mysql password
$db_name="Hospital_Database"; // Database name
$tbl_name="Doctor"; // Table name


// Connect to server and select databse.
$dbc = mysqli_connect("$host", "$username", "$password")or die("cannot connect");
mysqli_select_db($dbc, $db_name) or die("cannot select DB"); 


$Doctor_username = $_SESSION['session_user_name'];
$Doctor_password = $_SESSION['session_pass_word'];


$dbase_password_get ="SELECT Password FROM $tbl_name WHERE Username = '$Doctor_username' ";
$dbase_username_get ="SELECT Username FROM $tbl_name WHERE Username = '$Doctor_username' ";
$dbase_id_get ="SELECT Doctor_ID FROM $tbl_name WHERE Username = '$Doctor_username' ";

$dbase_username = mysqli_query($dbc, $dbase_username_get);
$dbase_password = mysqli_query($dbc, $dbase_password_get);
$get_id_resource = mysqli_query($dbc, $dbase_id_get);

mysqli_data_seek($dbase_username,0);
$db_username = mysqli_fetch_row($dbase_username);
$_SESSION['dusername'] = $db_username;
mysqli_data_seek($dbase_password,0);
$db_password = mysqli_fetch_row($dbase_password);


	if ($Doctor_username == $db_username[0] and $Doctor_password == $db_password[0]){
	mysqli_data_seek($get_id_resource,0);
	$fetched_id = mysqli_fetch_row($get_id_resource);
	$_SESSION['ID'] = $fetched_id;
	$dbase_name_get ="SELECT Name FROM $tbl_name WHERE Username = '$Doctor_username' ";
	$get_name_resource = mysqli_query($dbc, $dbase_name_get);
	mysqli_data_seek($get_name_resource,0);
	$db_dname = mysqli_fetch_row($get_name_resource);
	$_SESSION['doctorname'] = $db_dname[0];
    header('Location: ../Views/securitykeyinput.php');
	} else {
		header('Location: ../Views/loginfailure.html');
	}


?>