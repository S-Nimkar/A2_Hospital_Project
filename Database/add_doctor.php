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

$new_tbl_name= $_POST['username']; // Table name

$doctorname= $_POST['wholename'];
$username= $_POST['username'];
$password= $_POST['password'];
$securitykey = $_POST['skey'];

$new_tbl_name .= "_table";

$insert_doctor_sql="INSERT INTO $tbl_name (Name,Username,Password,SecurityKey) Values('$doctorname','$username','$password','$securitykey')";

$usernamechecksql ="SELECT Username FROM $tbl_name WHERE Username = '$username' ";

$createdoctorstablesql= "CREATE TABLE $new_tbl_name ( 
Doctors_Patient_ID INT(11) NOT NULL AUTO_INCREMENT,
ReferenceID INT(11) NOT NULL ,
PRIMARY KEY (Doctors_Patient_ID),
FOREIGN KEY (ReferenceID) REFERENCES Patient(Patient_ID)
)";

$checked_username = mysqli_query($dbc, $usernamechecksql);

if (mysqli_num_rows($checked_username) == 0 ){
	
   mysqli_query($dbc, $insert_doctor_sql);
   if(mysqli_query($dbc, $createdoctorstablesql)){
   	header('Location: ../Views/admin_doctor_view.php');
   }else{
   	header('Location: ../Views/server_error.html');
   }
   
}else {
   header('Location: ../Views/server_error.html');
}


?>