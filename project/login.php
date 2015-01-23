<?

include 'includes/addFunctions.php';
include 'includes/getFunctions.php';
include 'includes/templates.php';
include 'includes/checks.php';

?>
<!doctype html>
<html>
    <head>
    	<?
    		head('Getting Started');

	        addCSS('static/css/main.css');
	        //font awesome
	        addCSS('static/font-awesome/css/font-awesome.min.css');
        ?>
    </head>
    <body>
    	<?
    		pageHeader();
    	?>

		<main id="mainContent">
			<div id="background"></div>
			<?
				$point = 0;
				if(isset($_POST['new'])) {
					$point = 1;
				} else if(isset($_POST['next1'])) {
					$point = 2;
				} else if(isset($_POST['next2'])) {
					$point = 3;
				} else if(isset($_POST['login']) || isset($_POST['start'])) {
					$point = 4;
				} else if($_POST['loginUser']) {
					$point = 4;
					$klantNummer 	= $_POST['klantNummer'];
					$wachtwoord = $_POST['wachtwoord'];
					checkLogin($klantNummer, $wachtwoord);
				}
			?>

			<? if($point == 0): ?>
				<section id="starting" class="stap1">
					Met <span>WoonEnergie</span> <br/>
					gemakkelijk besparen aan de hand van een persoonlijk doel
					<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
						<button type="submit" name="new">Nu starten met besparen</button>
						<button type="submit" name="login">Al een account? Log in</button>
					</form>
				</section>
			<? elseif($point == 1): ?>
				<section id="starting" class="stap2">
					<article>
						<h1>Woning gegevens</h1>
						Om een beter, haalbaar en realistisch bespaardoel in te kunnen stellen hebben wij een aantal gegevens nodig
					</article>

					<article>
						<h1>Type huis:</h1>
						<ul id="house">
							<li class="active">Appartement</li>
							<li>Tussenwoning</li>
							<li>Hoekwoning</li>
							<li>Vrijstaand</li>
						</ul>
					</article>

					<article>
						<h1>Aantal personen in uw huishouden:</h1>
						<ul id="persons">
							<li class="active">1</li>
							<li>2</li>
							<li>3</li>
							<li>4</li>
							<li>5+</li>
						</ul>
					</article>
					<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
						<button class="steps" type="submit" name="next1">Volgende 1/3</button>
					</form>
				</section>
			<? elseif($point == 2): ?>
				<section id="starting" class="stap3">
					<article>
						<h1>Bespaardoel instellen</h1>
						Om effecient te besparen in het bewezen dat u sneller bespaart als u een bespaardoel instelt. 
						Door deze in te vullen kunnen wij u sneller aan uw doel helpen door relevante tips en hulp aan te boeden
					</article>

					<article>
						<h1>Kies hoeveel u wilt besparen:</h1>
						<ul id="house">
							<li class="active">&euro;60</li>
							<li>&euro;90</li>
							<li>&euro;250</li>
							<li>Ander bedrag</li>
						</ul>
					</article>

					<article>
						<h1>Over hoeveel tijd:</h1>
						<ul id="persons">
							<li class="active">6 maanden</li>
							<li>1 jaar</li>
							<li>1.5 jaar</li>
							<li>Ander termijn</li>
						</ul>
					</article>
					<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
						<button class="steps" type="submit" name="next2">Volgende 2/3</button>
					</form>
				</section>
			<? elseif($point == 3): ?>
				<section id="starting" class="stap4">
					<article>
						<h1>Meterstand invoeren</h1>
						Om cijfers te laten kloppen hebben we uw meterstanden nodig. 
						Dankzij de slimme meter zullen deze gegevens automatisch bijgewerkt worden.
					</article>

					<article>
						<i class="fa fa-plug"></i> <em>Electriciteit</em>
						<input type="number" placeholder="Vul hier uw meterstand in" />
						<i class="fa fa-tint"></i> <em>Water</em>
						<input type="number" placeholder="Vul hier uw meterstand in" />
						<i class="fa fa-fire"></i> <em>Gas</em>
						<input type="number" placeholder="Vul hier uw meterstand in" />
					</article>
					<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
						<button class="steps" type="submit" name="start">Start met besparen</button>
					</form>
				</section>
			<? elseif($point == 4): ?>
					<form id="loginForm" method="post" action="<?=$_SERVER['PHP_SELF']?>">
						<legend>Inloggen Mijn WoonEnergie</legend>
						<span>*login prototype: 123456789 / wachtwoord</span>

						<input type="text" name="klantNummer" placeholder="Klantnummer">
						<input type="password" name="wachtwoord" placeholder="Wachtwoord">

						<input id="loginButton" type="submit" value="Inloggen" name="loginUser">
						
						<!-- 
						<a href="#vergeten">Inloggegevens vergeten?</a> <br/>
						<a href="#aanvragen">Mijn WoonEnergie aanvragen?</a> 
						-->
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
		<script>
			// We all <3 quick fixes
			$('#navButton').hide();

			$('#starting ul li').click(function() {
				$(this).siblings('.active').removeClass('active');
				$(this).addClass('active');
			});
		</script>



    </body>
</html>