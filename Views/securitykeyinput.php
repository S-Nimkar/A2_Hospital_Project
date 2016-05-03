<?php
session_start();
if ($_SESSION['active'] != "2") {
  header('Location: server_error.html');
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<header>
  <nav class = "nav-bar-container">
      <div class="navbar-fixed">
          <a href="homelogin.html" class="brand-logo center-align tooltipped nav-bar-logo" data-position="right" data-delay="50" data-tooltip="Nimkar Medical Practitioners">NMP
          </a>
    </div>
  </nav>
</header>
<body class="registration_success_background">

<div class="container registration_success_content mdl-card">

<p class="registration_success_title center">Security Key</p>
<p class="light center registration_success_textmargins">Please enter security key:</p>

<div class="container center">
<form name="skey" onsubmit="return validatekey()" action="../Database/securitykey_validate.php" method='POST'>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label security-key-input">
        <input class="mdl-textfield__input" type="text" pattern="^[a-zA-Z0-9_.-]*$" name="securitykey">
        <label class="mdl-textfield__label" for="sample3">Security Key</label>
        <span class="mdl-textfield__error security-key-spans relative" name="skey-error">Please enter english letters and numbers only (Maximum length is 16)</span>
      </div>
	<button class="mdl-button mdl-js-button mdl-button--raised waves-effect waves-light btn-large registration_success_button">
        Submit
  </button>
  <form>
</div>
</div>
</body>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/jquery-2.2.1.min.js"></script>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/materialize.min.js"></script>
	<script type="text/javascript" src="../Scripts/Minified-Scripts/material.min.js"></script>
	<script type="text/javascript" src="../Scripts/securitykey.js"></script>
</html>
