<?php 
session_start();
$_SESSION['active'] = '0';
header('Location: ../Views/homelogin.html');


?>