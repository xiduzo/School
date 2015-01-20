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
    		head('community');

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

			<div id="headerBalk">
				<div id="plainText">Uw persoonlijke bespaartips</div>
			</div>

			<section id="bespaarTips">
				<ul>
					<li>
						<h1>Water bespaartip</h1>
					</li>
					<li>
						<h1>Water bespaartip</h1>
					</li>
					<li>
						<h1>Water bespaartip</h1>
					</li>
					<li>
						<h1>Water bespaartip</h1>
					</li>
				</ul>
			</section>

			
		</main>

		<?
			$userName = $user['voorNaam']." ".$user['achterNaam'];
			mainNavigation($userName, 'community');
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