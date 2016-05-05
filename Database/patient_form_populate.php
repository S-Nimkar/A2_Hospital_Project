<?php 
session_start();
if ($_SESSION['active'] != "4" and $_SESSION['requestpage'] != "true") {
	header('Location: ../Views/server_error.html');
	die;
	//forward to server generic error access
}
$host="localhost"; // Host name
$username="root"; // Mysql username
$password="root"; // Mysql password
$db_name="Hospital_Database"; // Database name
$_SESSION['requestpage'] = 'default';
// Connect to server and select databse.
$dbc = mysqli_connect("$host", "$username", "$password")or die("cannot connect");
mysqli_select_db($dbc, $db_name) or die("cannot select DB"); 
$form_age = $_POST['age'];
$form_dob = $_POST['date_of_birth'];
$form_home_number = $_POST['home_number'];
$form_mobile_number = $_POST['mobile_number'];
$form_postcode = $_POST['postcode'];
$form_allergies = $_POST['allergies'];
$form_past_conditions = $_POST['past_conditions'];
$form_extra_info = $_POST['extra_info'];

$insertinto_standardinfo_sql = "INSERT INTO Standard_Information (Age, Date_of_Birth, Home_Number, Mobile_Number, Postcode, Allergies, Past_Conditions, Extra_Info) VALUES ('$form_age','$form_dob','$form_home_number','$form_mobile_number','$form_postcode','$form_allergies','$form_past_conditions','$form_extra_info')";
$insert_withouthnum_sql = "INSERT INTO Standard_Information (Age, Date_of_Birth, Mobile_Number, Postcode, Allergies, Past_Conditions, Extra_Info) VALUES ('$form_age','$form_dob','$form_mobile_number','$form_postcode','$form_allergies','$form_past_conditions','$form_extra_info')";
$insert_withoutmnum_sql = "INSERT INTO Standard_Information (Age, Date_of_Birth, Home_Number, Postcode, Allergies, Past_Conditions, Extra_Info) VALUES ('$form_age','$form_dob','$form_home_number','$form_postcode','$form_allergies','$form_past_conditions','$form_extra_info')";
$insert_without_bothnum_sql = "INSERT INTO Standard_Information (Age, Date_of_Birth, Postcode, Allergies, Past_Conditions, Extra_Info) VALUES ('$form_age','$form_dob','$form_postcode','$form_allergies','$form_past_conditions','$form_extra_info')";

if ($form_home_number == "" and $form_mobile_number == "") {
	mysqli_query($dbc,$insert_without_bothnum_sql);
} elseif ($form_home_number != "" and $form_mobile_number == "") {
	mysqli_query($dbc,$insert_withoutmnum_sql);
} elseif ($form_home_number == "" and $form_mobile_number != "") {
	mysqli_query($dbc,$insert_withouthnum_sql);
} else {
	mysqli_query($dbc,$insertinto_standardinfo_sql);
}

$standard_info_id = mysqli_insert_id($dbc);

$currentformtype_id = $_SESSION['current_form_typeid'];
$insertinto_formdetails_sql = "INSERT INTO Form_Details (Standard_Info_ID, Form_Type_ID) VALUES ('$standard_info_id','$currentformtype_id')";
mysqli_query($dbc,$insertinto_formdetails_sql);

$form_details_id = mysqli_insert_id($dbc);
$currentpatient_id = $_SESSION['current_form_patientid'];
$currentdoctor_id = $_SESSION['current_form_doctorid'];

$insertinto_completedform_sql = "INSERT INTO Completed_Forms (Patient_ID, Doctor_ID, Details_ID) VALUES ('$currentpatient_id','$currentdoctor_id','$form_details_id')";
if (mysqli_query($dbc,$insertinto_completedform_sql)){
	$formrequest_id = $_SESSION['current_requested_form'];
	$deletedform_requst_sql = "DELETE FROM Requested_Forms WHERE Requested_Form_ID = '$formrequest_id'";
	mysqli_query($dbc,$deletedform_requst_sql);
	header('Location: ../Views/patient_pending_forms.php');
}


?>