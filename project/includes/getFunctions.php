<?
session_start();

include '../required/config.php';

function getUser($user){

	$q 	= "SELECT * FROM school_project_users WHERE klantNummer = ".$user."";

	$host	=	"sql8.pcextreme.nl";
	$user	= 	"63744sanderboer";
	$pass	=	"Feyenoord1994!";
	$db 	= 	"63744sanderboer";

	$checkConnection = mysqli_connect($host,$user,$pass,$db) or die('Geen connectie mogenlijk met de database');

	$result = mysqli_query($checkConnection, $q) or die("Error: ".mysqli_error($checkConnection));

	$userArray = mysqli_fetch_assoc($result);

	return $userArray;

}

?>