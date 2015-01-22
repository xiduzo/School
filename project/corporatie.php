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
    		head('Corporatie');

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
				<div id="plainText">Berichten van uw woningcorporatie</div>
			</div>

			<section id="bespaarTips">
				<ul>
				<?
					$allPosts = getPosts(2);

					while($post = mysqli_fetch_array($allPosts)){
						echo '
						<li>
							<article>
								<h1>'.$post['titel'].'</h1>
								<p>
									'.$post['bericht'].'
								</p>
							</article>
						</li>
						';
					}
				?>
				</ul>
			</section>

			
		</main>

		<?
			$userName = $user['voorNaam']." ".$user['achterNaam'];
			mainNavigation($userName, 'corporatie');
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