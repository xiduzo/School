<?
session_start();


include '../required/config.php';

function checkUser() {
	if(empty($_SESSION['user'])){
		if($_SERVER['SCRIPT_NAME'] != '/school/project/login.php') {
			header('location: /school/project/login.php');
			die();
		}
	} elseif(!empty($_SESSION['user'])) {
		if($_SERVER['SCRIPT_NAME'] == '/school/project/login.php') {
			header('location: /school/project/index.php');
			die();
		}
	}
}

function checkLogin($username, $password) {

	$host	=	"sql8.pcextreme.nl";
	$user	= 	"63744sanderboer";
	$pass	=	"Feyenoord1994!";
	$db 	= 	"63744sanderboer";

	$checkConnection = mysqli_connect($host,$user,$pass,$db);

	if(mysqli_connect_errno()){
		echo "Er is iets mis gegaan met MYSQL: " . mysqli_connect_error();
		die();
	}

	$q 	= "	SELECT `klantNummer` 
			FROM school_project_users 
			WHERE klantNummer = ".$username." 
			AND wachtwoord = `".$password."`
		";

	$result = mysqli_query($checkConnection, $q) or die("Error: ".mysqli_error($checkConnection));

	if($result){
		while($user = mysqli_fetch_assoc($result)){
			$_SESSION['user'] = $user['klantNummer'];
			header('location: /school/project/index.php');
		}	
	} else {
		echo 'Geen goede login';
	}
	
}

?>