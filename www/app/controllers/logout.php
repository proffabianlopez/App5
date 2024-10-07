<?php
//session_unset();
session_start();
if (!isset($_SESSION['id'])) {
	session_destroy();
	unset($_SESSION['rol']);
	unset($_SESSION['user']);
}


header("Location:../views/login.php");

?>