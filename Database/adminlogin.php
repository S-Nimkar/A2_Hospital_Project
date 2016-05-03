<?php 
session_start();
if ($_SESSION['active'] != "1") {
	header('Location: ../Views/server_error.html');
	die;
	//forward to server generic error access
}
$_SESSION['active'] = '2';
$_SESSION['securitykeyid'] = 'Admin_ID'; 
$_SESSION['TableName'] = 'Administrator';
$host="localhost"; // Host name
$username="root"; // Mysql username
$password="root"; // Mysql password
$db_name="Hospital_Database"; // Database name
$tbl_name="Administrator"; // Table name


// Connect to server and select databse.
$dbc = mysqli_connect("$host", "$username", "$password")or die("cannot connect");
mysqli_select_db($dbc, $db_name) or die("cannot select DB"); 


$Admin_username = $_SESSION['session_user_name'];
$Admin_password = $_SESSION['session_pass_word'];


$dbase_password_get ="SELECT Password FROM $tbl_name WHERE Username = '$Admin_username' ";
$dbase_username_get ="SELECT Username FROM $tbl_name WHERE Username = '$Admin_username' ";
$dbase_id_get ="SELECT Admin_ID FROM $tbl_name WHERE Username = '$Admin_username' ";

$dbase_username = mysqli_query($dbc, $dbase_username_get);
$dbase_password = mysqli_query($dbc, $dbase_password_get);
$get_id_resource = mysqli_query($dbc, $dbase_id_get);

mysqli_data_seek($dbase_username,0);
$db_username = mysqli_fetch_row($dbase_username);

mysqli_data_seek($dbase_password,0);
$db_password = mysqli_fetch_row($dbase_password);


	if ($Admin_username == $db_username[0] and $Admin_password == $db_password[0]){

	mysqli_data_seek($get_id_resource,0);
	$fetched_id = mysqli_fetch_row($get_id_resource);
	$_SESSION['ID'] = $fetched_id;

   header('Location: ../Views/securitykeyinput.php');
	} else {
		header('Location: ../Views/loginfailure.html');
	}


?>