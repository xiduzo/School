<?
session_start();

include 'includes/addFunctions.php';
include 'includes/getFunctions.php';
include 'includes/templates.php';
include 'includes/checks.php';

checkUser();

$user = getUser($_SESSION['user']);

?>
<!doctype html>
<html>
    <head>
    	<?
    		head('home');

	        addCSS('static/css/main.css');
	        //font awesome
	        addCSS('static/font-awesome/css/font-awesome.min.css');
        ?>
    </head>
    <body>
    	<?
    		pageHeader();
    	?>

    	<div id="popUpScreen">
			<section id="popUpVisableScreen">
				<button id="closePopUpScreen" onclick="closePopUpScreen()"><i class="fa fa-close"></i></button>
				<h1>Vul hier de meest recente meterstand in</h1>
				<p>De meterstand is te vinden in de meterkast.</p>
				<form id="readForm" method="post" action="<?=$_SERVER['PHP_SELF']?>">

					<input type="number" name="amount" placeholder="Vul hier de meterstand in">

					<input id="addRead" type="submit" value="Voeg nieuwe meterstand toe" name="addRead">
				</form>
			</section>
		</div>

		<script type="text/javascript">
			function addNewRead() {
				$("#popUpScreen").toggleClass("active");
			}

			function closePopUpScreen() {
				$("#popUpScreen").toggleClass("active");
			}
		</script>

		<main  id="mainContent">
		<div id="background"></div>

		<div id="headerBalk">
			<div id="plainText">Mijn meterstanden</div>
		</div>

		<section id="readingsSection">
			<ul>
				<li>
					<header class="energy"></header>
					<i class="fa fa-plug"></i>
					<h1>Electriciteit</h1>
					<div class="current">
						<? 							
							echo number_format(getLastReading($user['klantNummer'], 1),2);
						?>
					</div>
					<div class="newReading">
						<button onclick="addNewRead()"><i class="fa fa-plus"></i></button>
					</div>
				</li>						
				<li>
					<header class="water"></header>
					<i class="fa fa-tint"></i>
					<h1>Water</h1>
					<div class="current">
						<? 
							echo number_format(getLastReading($user['klantNummer'], 2),2); 
						?>
					</div>
					<div class="newReading">
						<button onclick="addNewRead()"><i class="fa fa-plus"></i></button>
					</div>
				</li>						
				<li>
					<header class="gas"></header>
					<i class="fa fa-fire"></i>
					<h1>Gas</h1>
					<div class="current">
						<? 
							echo number_format(getLastReading($user['klantNummer'], 3),2); 
						?>
					</div>
					<div class="newReading">
						<button onclick="addNewRead()"><i class="fa fa-plus"></i></button>
					</div>
				</li>
			</ul>
		</section>

		</main>

		<?
			$userName = $user['voorNaam']." ".$user['achterNaam'];
			mainNavigation($userName, 'meterstand');
		?>

		<!-- JS scripts -->
		<?
			// Extern
			addJS('static/js/extern/hammer.min.js');
			addJS('static/js/extern/jquery-1.7.1.min.js');
			addJS('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
			addJS('http://d3js.org/d3.v3.min.js');

			// Self
			addJS('static/js/menuToggle.js');
		?>
    </body>
</html>