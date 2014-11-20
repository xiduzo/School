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

		<? if($_POST['sendMail']): ?>
			<?
				$email = $_POST['email'];
				sendForgotEmail($email);
			?>
		<? else: ?>
			<form id="forgotForm" method="post" action="<?=$_SERVER['PHP_SELF']?>">
				<legend>

					Inloggegevens vergeten

					<span>
						Als u uw inloggegevens vergetent bent, kunt u deze opvragen.<br/>
						Vul hieronder uw e-mailadres in, zoals u die eerder van ons heeft doorgegeven.<br/>
						U ontvangt dan een e-mail met daarin een link waarmee u uw gebruikersnaam opvraagt en een nieuw wachtwoord kunt kiezen.
					</span>

				</legend>

				<input type="text" name="email" placeholder="E-mailadres">

				<input id="forgotButton" type="submit" value="Verstuur" name="sendMail">

				<a href="/school/project/login.php">Inloggen</a> <br/>
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
			addJS('static/js/functions.js');
		?>
    </body>
</html>