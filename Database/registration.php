<?php
session_start();
$host="localhost"; // Host name
$username="root"; // Mysql username
$password="root"; // Mysql password
$db_name="Hospital_Database"; // Database name
$tbl_name="Patient"; // Table name


// Connect to server and select databse.
$dbc = mysqli_connect("$host", "$username", "$password")or die("cannot connect");
mysqli_select_db($dbc, $db_name) or die("cannot select DB"); 

$first_name =$_POST['first_name'];
$surname =$_POST['surname'];
$email =$_POST['c_email'];
$user_name =$_POST['username'];
$pass_word =$_POST['check_password'];

$insert_patient_sql="INSERT INTO $tbl_name (Fname,Sname,Email_address,Username,Password) Values('$first_name','$surname','$email','$user_name','$pass_word')"; //populate the database with patient data

$emailchecksql ="SELECT Email_address FROM $tbl_name WHERE Email_address = '$email' ";

$checked_email = mysqli_query($dbc, $emailchecksql);


$usernamechecksql ="SELECT Username FROM $tbl_name WHERE Username = '$user_name' ";

$checked_username = mysqli_query($dbc, $usernamechecksql);

$msg = "Your registration to sign up with NMP has been succesfull! Your username is : ' $user_name '  and your password is : ' $pass_word ' . We hope you find the use of our service to be satisfactory and if there are any inquries the contanct address is support@nmp.org ";

if (mysqli_num_rows($checked_username) == 0 and mysqli_num_rows($checked_email) == 0){
	
   mail($email,"NMP Registration was successfull!",$msg);
   mysqli_query($dbc, $insert_patient_sql);
   //add registration success page
   header('Location: ../Views/registrationsuccess.html');
}else {
   //add login failure
   header('Location: ../Views/registrationfailure.html');
}



?>