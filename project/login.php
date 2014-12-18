<?
session_start();

include 'includes/addFunctions.php';
include 'includes/templates.php';
include 'includes/checks.php';

checkUser();

?>
<!doctype html>
<html>
    <head>
    	<?
    		head('login');

	        addCSS('static/css/main.css');
	        //font awesome
	        addCSS('static/font-awesome/css/font-awesome.min.css');
        ?>
    </head>
    <body>

		<main id="mainContent">
		<div id="background"></div>

		<? if($_POST['loginUser']): ?>
			<?
				$klantNummer = $_POST['klantNummer'];
				$wachtwoord = $_POST['wachtwoord'];
				checkLogin($klantNummer, $wachtwoord);
			?>
		<? else: ?>
			<form id="loginForm" method="post" action="<?=$_SERVER['PHP_SELF']?>">
				<legend>Inloggen Mijn WoonEnergie</legend>

				<input type="text" name="klantNummer" placeholder="Klantnummer">
				<input type="password" name="wachtwoord" placeholder="Wachtwoord">

				<input id="loginButton" type="submit" value="Inloggen" name="loginUser">

				<a href="/school/project/forgot.php">Inloggegevens vergeten?</a> <br/>
				<a href="#aanvragen">Mijn WoonEnergie aanvragen?</a>
			</form>
		<? endif; ?>
			
		</main>


		<!-- JS scripts -->
		<?
			// Extern
			addJS('static/js/extern/hammer.min.js');
			addJS('static/js/extern/jquery-1.7.1.min.js');

			// Self
		?>
    </body>
</html>