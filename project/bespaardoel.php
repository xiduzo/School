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
    		head('Bespaardoel');

	        addCSS('static/css/main.css');
	        //font awesome
	        addCSS('static/font-awesome/css/font-awesome.min.css');
        ?>
    </head>
    <body>
    	<?
    		pageHeader();
    	?>

		<main  id="mainContent">
		<div id="background"></div>
		
		<?
			$goalSet  = false;

			if (isset($_POST['setGoal'])) {
				$goalSet = true;
				$price 	= $_GET['savingsGoal'];
				$name 	= $_GET['savingsName'];
			}
		?>

		<div id="headerBalk">
			<? if($goalSet): ?>
				<div id="plainText">Pas uw bespaardoel aan</div>
			<? else: ?>
				<div id="plainText">Stel uw eigen bespaardoel in</div>
			<? endif; ?>
		</div>

		

		<? if($goalSet): ?>

		<section id="goalSection">
			<img src="http://www.jamet.nl/file646.jpg" alt="vouwwagen">
		</section>

		<section id="goalPriceSection">
			<article>
				<p>
					<span>Bespaardoel aanpassen</span> <br/>
					verander hier uw persoonlijke bespaardoel. <br/>
				</p>

				<form id="savingsGoal" method="post" action="<?=$_SERVER['PHP_SELF']?>">

					<input type="text" name="savingsName" value="Vouwwagen">
					<input type="number" name="savingsGoal" value="149.99">

					<button type="submit" name="setGoal">Verander bespaardoel</button>
				</form>
			</article>
		</section>

		<? else :?>

		<section id="goalSection">
			<!-- <img src="http://www.vouwwagenpunt.nl/wp-content/uploads/2012/02/Wolder-hogar1-vouwwagen1.jpg" alt="vouwwagen"> -->
			<div class="fileUpload">
			    <span><i class="fa fa-plus"></i></span>
			    <input type="file" class="upload" />
			</div>
		</section>

		<section id="goalPriceSection">
			<article>
				<p>
					<span>Bespaardoel instellen</span> <br/>
					stel hier uw persoonlijke bespaardoel in. <br/>
				</p>

				<form id="savingsGoal" method="post" action="<?=$_SERVER['PHP_SELF']?>">

					<input type="text" name="savingsName" placeholder="Naam bespaardoel">
					<input type="number" name="savingsGoal" placeholder="Vul hier de prijs van uw doel in">

					<button type="submit" name="setGoal">Stel bespraardoel in</button>
				</form>
			</article>
		</section>

		<? endif; ?>
		


		</main>

		<?
			$userName = $user['voorNaam']." ".$user['achterNaam'];
			mainNavigation($userName, 'bespaardoel');
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