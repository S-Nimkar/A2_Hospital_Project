<?php
session_start();

$_SESSION['active'] = '1';
$_SESSION['session_user_name'] =  $_POST['user_name'];
$_SESSION['session_pass_word'] =  $_POST['pass_word'];


if (isset($_POST['logintype']))    
{    
	$login_selected = $_POST['logintype'];
          // Instructions if $_POST['value'] exist    
} 
 
switch ($login_selected) {
	case "patient":
		header('Location: patientlogin.php');
		break;
	case "doctor":
		header('Location: doctorlogin.php');
		break;
	case "admin":
		header('Location: adminlogin.php');
		break;
	default:
		header('Location: ../Views/server_error.html');
		break;
}

?>