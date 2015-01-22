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
			?>

			<? if($point == 0): ?>
				<section id="starting" class="stap1">
					Met <span>WoonEnergie</span> <br/>
					gemakkelijk besparen aan de hand van een persoonlijk doel
					<button>Nu starten met besparen</button>
					<button>Al een account? Log in</button>
				</section>
			<? elseif($point = 1): ?>
			<? endif; ?>
			<section>
				
			</section>
				

		</main>

		<!-- JS scripts -->
		<?
			// Extern
			addJS('static/js/extern/hammer.min.js');
			addJS('static/js/extern/jquery-1.7.1.min.js');

			// Self
		?>
		<script>
			$('#navButton').hide();
		</script>

    </body>
</html>