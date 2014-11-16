<?
session_start();

require("../required/config.php");

function checkUser() {
	if(empty($_SESSION['user'])){
		if($_SERVER['SCRIPT_NAME'] != '/school/project/login.php') {
			header('location: /school/project/login.php');
			die();
		}
	}
}

function checkLogin($username, $password) {

	$q 	= "SELECT klantNummer FROM school_project_users WHERE klantNummer = $username AND wachtwoord = $password";

	$result = mysqli_query($checkConnection,$q) or die("Error: ".mysqli_error($check_connectie));

	if($result) {
		$_SESSION['user'] = $result;
	} else {
		echo 'Geen goede login';
	}
	
}

?>