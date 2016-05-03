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
$tbl_name= "Administrator"; // Table name


// Connect to server and select databse.
$dbc = mysqli_connect("$host", "$username", "$password")or die("cannot connect");
mysqli_select_db($dbc, $db_name) or die("cannot select DB"); 

$adminsid = $_POST['id'];

$idchecksql ="SELECT Admin_ID FROM $tbl_name WHERE Admin_ID = '$adminsid' ";

$delete_from_admin_table ="DELETE FROM $tbl_name WHERE Admin_ID ='$adminsid'";

$checked_id = mysqli_query($dbc, $idchecksql);

$rowgetsql = "SELECT * FROM $tbl_name";
$rowresult = mysqli_query($dbc,$rowgetsql);
if (mysqli_num_rows($rowresult) == 1 ){
    $_SESSION['removal'] = '1';
  header('Location: ../Views/admin_remove_admin.php');
}
  

if (mysqli_num_rows($checked_id) == 1 ){
  mysqli_query($dbc, $delete_from_admin_table);
  header('Location: ../Views/admin_admin_view.php');
} else {
  //noworking
  $_SESSION['removal'] = 'fail';
  header('Location: ../Views/admin_remove_admin.php');
}


?>