<?php 
session_start();
if ($_SESSION['active'] != "5") {
	header('Location: ../Views/server_error.html');
	die;
	//forward to server generic error access
}

$host="localhost"; // Host name
$username="root"; // Mysql username
$password="root"; // Mysql password
$db_name="Hospital_Database"; // Database name


// Connect to server and select databse.
$dbc = mysqli_connect("$host", "$username", "$password")or die("cannot connect");
mysqli_select_db($dbc, $db_name) or die("cannot select DB"); 

$currentformid = $_POST['completedformid'];
$doctor_id = $_SESSION['doctorid'];

$checkif_doctors_form_sql = "SELECT * FROM Completed_Forms WHERE Doctor_ID = '$doctor_id' AND Completed_Form_ID = '$currentformid'";
$Completed_Form_result = mysqli_query($dbc,$checkif_doctors_form_sql);

if (mysqli_num_rows($Completed_Form_result) == 0) {
	$_SESSION['assign_result'] = 'noform';
	header('Location: ../Views/doctor_completed_forms.php');
} else{
	$_SESSION['loadedform'] = 'true';
	
	$completed_form = mysqli_fetch_row($Completed_Form_result);
	$patientid = $completed_form[1];
	$detailsid = $completed_form[3];


	$getpatients_name_sql = "SELECT FName,SName,Email_address FROM Patient WHERE Patient_ID = '$patientid'";
	$patient_name_result = mysqli_query($dbc,$getpatients_name_sql);
	$patientsname = mysqli_fetch_row($patient_name_result);

	//unset variables for next form
	unset($_SESSION['Patients_Name']);
	unset($_SESSION['Form_Type']);
	unset($_SESSION['Patient_Information']);

	$_SESSION['Patients_Name'] .= $patientsname[0];
	$_SESSION['Patient_Information'][Fname] = $patientsname[0];
	$_SESSION['Patients_Name'] .= ' ';
	$_SESSION['Patients_Name'] .= $patientsname[1];
	$_SESSION['Patient_Information'][Sname] = $patientsname[1];
	$_SESSION['Patient_Information'][Email] = $patientsname[2];

	$getdetailsinfo_sql = "SELECT * FROM Form_Details WHERE Form_Details_ID = '$detailsid'";
	$getdetails_result = mysqli_query($dbc,$getdetailsinfo_sql);
	$formdetails = mysqli_fetch_row($getdetails_result);
	$formtypeid = $formdetails[2];
	$patientinfoid = $formdetails[1];

	$getformtype_sql = "SELECT Form_Type FROM Form_Types WHERE Form_Type_ID = '$formtypeid'";
	$formtype_reuslt = mysqli_query($dbc,$getformtype_sql);
	$formtype = mysqli_fetch_row($formtype_reuslt);
	$_SESSION['Form_Type'] .= $formtype[0];

	$get_patients_info_sql = "SELECT * FROM Standard_Information WHERE Standard_Info_ID = '$patientinfoid'";
	$patient_info_result = mysqli_query($dbc,$get_patients_info_sql);
	$patient_info = mysqli_fetch_row($patient_info_result);
	$_SESSION['Patient_Information'][Age] = $patient_info[1];
	$_SESSION['Patient_Information'][DOB] = $patient_info[2];
	$_SESSION['Patient_Information'][Hnum] = $patient_info[3];
	$_SESSION['Patient_Information'][Mnum] = $patient_info[4];
	$_SESSION['Patient_Information'][Postcode] = $patient_info[5];
	$_SESSION['Patient_Information'][Allergies] = $patient_info[6];
	$_SESSION['Patient_Information'][Past_Conditions] = $patient_info[7];
	$_SESSION['Patient_Information'][Extra_Info] = $patient_info[8];

header('Location: ../Views/doctor_loaded_form.php');
}
?>
