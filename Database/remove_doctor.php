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
$tbl_name= "Doctor"; // Table name


// Connect to server and select databse.
$dbc = mysqli_connect("$host", "$username", "$password")or die("cannot connect");
mysqli_select_db($dbc, $db_name) or die("cannot select DB"); 

$doctorsid = $_POST['id'];

$idchecksql ="SELECT Doctor_ID FROM $tbl_name WHERE Doctor_ID = '$doctorsid' ";

$get_tablename="SELECT Username FROM $tbl_name WHERE Doctor_ID = '$doctorsid' ";

$delete_from_doctors_table ="DELETE FROM $tbl_name WHERE Doctor_ID ='$doctorsid'";

$checked_id = mysqli_query($dbc, $idchecksql);

if (mysqli_num_rows($checked_id) == 1 ){
  $tablenameresult = mysqli_query($dbc,$get_tablename);
  mysqli_data_seek($tablenameresult,0);
  $delete_table_name = mysqli_fetch_row($tablenameresult);

	$full_table_name = $delete_table_name[0];

  $full_table_name .="_table";

  $droptablesql ="DROP TABLE IF EXISTS $full_table_name";
  
  mysqli_query($dbc, $droptablesql);

  mysqli_query($dbc, $delete_from_doctors_table);

  header('Location: ../Views/admin_doctor_view.php');
} else {
  //noworking
  $_SESSION['removal'] = 'fail';
  header('Location: ../Views/admin_remove_doctor.php');
}


?>