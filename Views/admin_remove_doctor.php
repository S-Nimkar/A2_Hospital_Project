<?php
session_start();
if ($_SESSION['active'] != "3") {
	header('Location: ../Views/server_error.html');
	die;
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
	<link rel="stylesheet" type="text/css" href="../Styles/Minified-Styles/material.min.css">
    <link rel="stylesheet" type="text/css" href="../Styles/Minified-Styles/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" type="text/css" href="../Styles/master.css" media="screen,projection">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<header>
	<nav class = "nav-bar-container patient_admin_width">
  		<div class="navbar-fixed">
      		<a href="admin_homepage.php" class="sidenavbrand-logo brand-logo center-align tooltipped nav-bar-logo" data-position="right" data-delay="50" data-tooltip="Nimkar Medical Practitioners" >NMP
      		</a>
      		<a href="#" data-activates="nav-mobile" class="button-collapse top-nav full hide-on-large-only" style="margin-left: 30px;">
				<i class="material-icons">menu</i>
			</a>
		</div>
	</nav>
		<ul id="nav-mobile" class="side-nav fixed" style="transform: translateX(0%);">
            <ul>
              	<li class ="logo"><a href="admin_homepage.php" class="sidenav-brandlogo center-align nav-bar-logo " data-position="right" data-delay="50" style=" font-size: 5rem;">NMP
	      		</a>
	      		</li>
			      		<ul class="collapsible collapsible-accordion">
				          	<li>
					            <a class="collapsible-header">Doctors</a>
					            <div class="collapsible-body">
					              	<ul>
					                	<li><a href="admin_doctor_view.php">View Doctors</a></li>
				             	 	</ul>
			            		</div>
			          		</li>
			      	    </ul>
			      	    <ul class="collapsible collapsible-accordion">
				          	<li>
					            <a class="collapsible-header">Patients</a>
					            <div class="collapsible-body">
					              	<ul>
					              		<li><a href="admin_patient_view.php">View Patients</a></li>
				             	 	</ul>
			            		</div>
			          		</li>
			      	    </ul>
			      	    <ul class="collapsible collapsible-accordion">
				          	<li>
					            <a class="collapsible-header">Admins</a>
					            <div class="collapsible-body">
					              	<ul>
					              		<li><a href="admin_admin_view.php">View Admins</a></li>
				             	 	</ul>
			            		</div>
			          		</li>
			      	    </ul>
			      	    <ul class="collapsible collapsible-accordion">
				          	<li>
					            <a class="collapsible-header">Forms</a>
					            <div class="collapsible-body">
					              	<ul>
					              		<li><a href="admin_admin_view.php">View Forms</a></li>
				             	 	</ul>
			            		</div>
			          		</li>
			      	    </ul>
            </ul>
      </ul>
	</div>

</header>
<body class="registration_success_background">

<div class="container registration-container admin_submitbox">
    <div class="mdl-card z-depth-0 registration-card mdl-shadow-mobile">
      <div class="mdl-card__title card-title-registration center-align">
        <text class="full-width">Remove Doctor</text>
      </div>
      <form name="admin_form" method="post" onsubmit="return validateDeleteID()" action="../Database/remove_doctor.php" >
        <div class="registration-card-actions">
        <p style="font-size: 2rem;color: rgba(255, 0, 0, 0.82)">!!!PLEASE NOTE!!!</p>
        <p>This function is added to handle errors that have occured in the database and need to be removed.</p>
        <p>NEVER REMOVE a doctor that is in use as the doctors id is linked with the form and is used to link to them</p>
        <p> To delete a doctor enter the id and the doctor will be deleted and the table connected to him also droped</p>
               <?php 
        	if ($_SESSION['removal'] == "fail") {
        		echo "<p style =\"color: red;\"> The doctor removal could not be completed, please check that doctor you wish to remove exists.";
        	}
        	$_SESSION['removal'] ='default'
        ?>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-floating-text registration-text-inputs registration-input-widths registration-right">
            <input class="mdl-textfield__input" type="text" pattern="^[0-9]*$" name="id">
            <label class="mdl-textfield__label" for="id">Doctors ID</label>
            <span class="mdl-textfield__error absolute registration-spans" name="id-incorrect">Numbers Only</span>
            <span class="visibility-false absolute" name="id-length">Input is too long! >16 </span>
            <span class="visibility-false absolute registration-spans" name="id-missing">Please enter a ID</span>
          </div>
        </div>
        <div class="registration-card-actions center-align">
          <button class="mdl-button mdl-js-button mdl-button--raised waves-effect waves-light btn-large submit-button submit-margin-bottom" type="submit" name="submit">Remove Doctor
          </button>

        </div>
      </form>
    </div>
      <script type="text/javascript" src="../Scripts/Minified-Scripts/jquery-2.2.1.min.js"></script>
  <script type="text/javascript" src="../Scripts/Minified-Scripts/materialize.min.js"></script>
  <script type="text/javascript" src="../Scripts/Minified-Scripts/material.min.js"></script>
  <script type="text/javascript" src="../Scripts/admin_homepage.js"></script>
  <script type="text/javascript" src="../Scripts/remove_doctor.js"></script>

    </body>

</html>
