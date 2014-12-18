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
			<?
					$viewToggle 	= $_GET['viewToggle'] ? $_GET['viewToggle'] : 'energy';
			?>
			<div id="headerBalk">
				<ul id="displayToggle">
					<li><a href="?viewToggle=energy" <?=$viewToggle == 'energy' ? 'class="active"' : ''?>><i class="fa fa-plug"></i></a></li>
					<li><a href="?viewToggle=water" <?=$viewToggle == 'water' ? 'class="active"' : ''?>><i class="fa fa-tint"></i></a></li>
					<li><a href="?viewToggle=gas" <?=$viewToggle == 'gas' ? 'class="active"' : ''?>><i class="fa fa-fire"></i></a></li>
				</ul>
			</div>

			<? if($viewToggle == 'energy'): ?>
				<div id="detailDataDisplay">
					<?
						detailDisplayInfo('Energie', number_format(rand(100,1000)/100,1), 'minder', rand(500,2000)/100);
					?>

				</div>
			<? elseif($viewToggle == 'water'): ?>
				<div id="detailDataDisplay">
					<?
						detailDisplayInfo('Water', rand(5,35), 'minder', rand(100,300)/100);
					?>
					
				</div>
			<? elseif($viewToggle == 'gas'): ?>
				<div id="detailDataDisplay">
					<?
						detailDisplayInfo('Gas', rand(5,35), 'minder', rand(100,300)/100);
					?>

				</div>
			<? endif; ?>
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

			// Self
			addJS('static/js/menuToggle.js');
		?>
    </body>
</html>