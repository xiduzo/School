<?
session_start();

include '../required/config.php';

function getUser($user, $checkConnection){

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

function getPosts($type) {

	$q = "SELECT * FROM";
	switch($type) {
		case 1:
			$q .= " school_project_posts";
			break;
		case 2:
			$q .= " school_project_berichten";
			break;
	}

	$q .= " ORDER BY RAND() LIMIT 0 , 4";

	$host	=	"sql8.pcextreme.nl";
	$user	= 	"63744sanderboer";
	$pass	=	"Feyenoord1994!";
	$db 	= 	"63744sanderboer";

	$checkConnection = mysqli_connect($host,$user,$pass,$db) or die('Geen connectie mogenlijk met de database');

	$result = mysqli_query($checkConnection, $q) or die("Error: ".mysqli_error($checkConnection));

	return $result;

}

function getPost($id) {

	$q = "SELECT * FROM school_project_posts WHERE id = ".$id."";

	$host	=	"sql8.pcextreme.nl";
	$user	= 	"63744sanderboer";
	$pass	=	"Feyenoord1994!";
	$db 	= 	"63744sanderboer";

	$checkConnection = mysqli_connect($host,$user,$pass,$db) or die('Geen connectie mogenlijk met de database');

	$result = mysqli_query($checkConnection, $q) or die("Error: ".mysqli_error($checkConnection));

	return $result;
}

function getUserName($userID) {

	$q = "SELECT * FROM school_project_users WHERE klantNummer = ".$userID."";

	$host	=	"sql8.pcextreme.nl";
	$user	= 	"63744sanderboer";
	$pass	=	"Feyenoord1994!";
	$db 	= 	"63744sanderboer";


	$checkConnection = mysqli_connect($host,$user,$pass,$db) or die('Geen connectie mogenlijk met de database');

	$result = mysqli_query($checkConnection, $q) or die("Error: ".mysqli_error($checkConnection));

	$userArray = mysqli_fetch_assoc($result);
	return $userArray['voorNaam']." ".$userArray['achterNaam'];
}

function getGoal($userID) {

	$q = "SELECT * FROM school_project_goal WHERE fromUser = ".$userID."";

	$host	=	"sql8.pcextreme.nl";
	$user	= 	"63744sanderboer";
	$pass	=	"Feyenoord1994!";
	$db 	= 	"63744sanderboer";

	$checkConnection = mysqli_connect($host,$user,$pass,$db) or die('Geen connectie mogenlijk met de database');

	$result = mysqli_query($checkConnection, $q) or die("Error: ".mysqli_error($checkConnection));

	return $result;

}

function getLastReading($user, $type) {

	$q = "SELECT * FROM school_project_usersUsage WHERE userNummer = ".$user."";

	switch($type) {
		case 1:
			$q .= " AND type = 1";
		break;
		case 2:
			$q .= " AND type = 2";
		break;
		case 3:
			$q .= " AND type = 3";
		break;
	}

	$host	=	"sql8.pcextreme.nl";
	$user	= 	"63744sanderboer";
	$pass	=	"Feyenoord1994!";
	$db 	= 	"63744sanderboer";

	$checkConnection = mysqli_connect($host,$user,$pass,$db) or die('Geen connectie mogenlijk met de database');

	$result = mysqli_query($checkConnection, $q) or die("Error: ".mysqli_error($checkConnection));

	$usageArray = mysqli_fetch_assoc($result);
	return $usageArray['newStand'];
}

?>