<?
	session_start();
	session_destroy();

	header('location: /school/project/login.php');
?>