<?
session_start();

include '../required/config.php';

function checkUser() {
	if(empty($_SESSION['user'])){
		if($_SERVER['SCRIPT_NAME'] != '/school/project/login.php') {
			header('location: /school/project/login.php');
			die();
		}
	}
}

function checkLogin($username, $password) {

	$host	=	"sql8.pcextreme.nl";
	$user	= 	"63744sanderboer";
	$pass	=	"Feyenoord1994!";
	$db 	= 	"63744sanderboer";

	$checkConnection = mysqli_connect($host,$user,$pass,$db) or die('Geen connectie mogenlijk met de database');

	$q 	= "SELECT klantNummer FROM school_project_users WHERE klantNummer = $username AND wachtwoord = $password";

	$result = mysqli_query($checkConnection, $q) or die("Error: ".mysqli_error($checkConnection));

	die($result);

	if($result) {
		$_SESSION['user'] = $result;
		header('location: /school/project/index.php');
	} else {
		echo 'Geen goede login';
	}
	
}

?>