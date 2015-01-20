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

		<main  id="mainContent">
		<div id="background"></div>
		
		<div id="headerBalk">
			<div id="plainText">Stel je eingen bespaardoel in</div>
		</div>

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
					stel hier je persoonlijke bespaardoel in. <br/>
				</p>

				<form id="savingsGoal" method="post" action="<?=$_SERVER['PHP_SELF']?>">

					<input type="text" name="savingsName" placeholder="Naam bespaardoel">
					<input type="number" name="savingsGoal" placeholder="Vul hier de prijs van je doel in">

					<button>Stel bespraardoel in</button>
				</form>
			</article>
		</section>


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