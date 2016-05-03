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
$tbl_name= "Administrator"; // Table name


// Connect to server and select databse.
$dbc = mysqli_connect("$host", "$username", "$password")or die("cannot connect");
mysqli_select_db($dbc, $db_name) or die("cannot select DB"); 


$username= $_POST['username'];
$password= $_POST['password'];
$securitykey = $_POST['skey'];


$insert_admin_sql="INSERT INTO $tbl_name (Username,Password,SecurityKey) Values('$username','$password','$securitykey')";

$usernamechecksql ="SELECT Username FROM $tbl_name WHERE Username = '$username' ";

$checked_username = mysqli_query($dbc, $usernamechecksql);

if (mysqli_num_rows($checked_username) == 0 ){
   mysqli_query($dbc, $insert_admin_sql);
   header('Location: ../Views/admin_admin_view.php');
}else {
   header('Location: ../Views/server_error.html');
}


?>