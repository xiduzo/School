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
    		head('Bespaartips');

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
				<?
					$allPosts = getPosts(1);

					while($post = mysqli_fetch_array($allPosts)){
						//showTip($titel, $tip, $omdat, $besparing);
						showTip($post['titel'], $post['tip'], $post['omdat'], $post['besparing']);
					}
				?>
			</section>

			
		</main>

		<?
			$userName = $user['voorNaam']." ".$user['achterNaam'];
			mainNavigation($userName, 'tips');
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