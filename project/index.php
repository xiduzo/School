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
		<?
		$savingGoal 	= 400.32;
		$randomPercent 	= rand(30, 70);
		$randomSaving  	= ($savingGoal * $randomPercent) / 100;
		?>
		<section id="mainSection">
			<div id="donut" data-donut="<?=$randomPercent?>" data-saving="<?=$randomSaving?>">
			<img src="http://www.vouwwagenpunt.nl/wp-content/uploads/2012/02/Wolder-hogar1-vouwwagen1.jpg" alt="vouwwagen">
			</div>
		</section>

		<section id="detailUseSection">
			<div id="showDetailButton"><i class="fa fa-chevron-up"></i> Bekijk meer info <i class="fa fa-chevron-up"></i></div>
		</section>

		</main>

		<?
			$userName = $user['voorNaam']." ".$user['achterNaam'];
			mainNavigation($userName, 'verbruik');
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
			addJS('static/js/detailViewToggle.js');
			addJS('static/js/donut.js');
		?>
    </body>
</html>