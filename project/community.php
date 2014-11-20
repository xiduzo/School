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

		<main  id="mainContent">
			<?
				$viewToggle 	= $_GET['viewToggle'] ? $_GET['viewToggle'] : 'all';
			?>
			<div id="viewToggle">

				<button id="newTip"><a href="#nieuweTip">Schrijf een tip</a></button>

				<ul id="forumToggle">
					<li><a href="?viewToggle=all" <?=$viewToggle == 'all' ? 'class="active"' : ''?>>Alle berichten</a></li>
					<li><a href="?viewToggle=corp" <?=$viewToggle == 'corp' ? 'class="active"' : ''?>>WoningCorp. berichten<span>2 nieuw</span></a></li>
					<li><a href="?viewToggle=tips" <?=$viewToggle == 'tips' ? 'class="active"' : ''?>>Besparingstips</a></li>
				</ul>
			</div>

			<div id="posts">
				<div class="post">
					<header></header>
				</div>

				<div class="post">
					<header></header>
				</div>

				<div class="post">
					<header></header>
				</div>

				<div class="post">
					<header></header>
				</div>

				<div class="post">
					<header></header>
				</div>

				<div class="post">
					<header></header>
				</div>

				<div class="post">
					<header></header>
				</div>

				<div class="post">
					<header></header>
				</div>
			</div>
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
			addJS('static/js/functions.js');
		?>
    </body>
</html>