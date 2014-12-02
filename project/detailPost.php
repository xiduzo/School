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

			<? if(empty($_GET['postID']) || !is_numeric($_GET['postID'])): ?>
				<h1>geen post gevonden</h1>
			<? else: ?>
				<?
					$post = getPost($_GET['postID']);
					while($postContent = mysqli_fetch_array($post)){
						echo '
							<div class="detailPost">
								<header>
								<img src="data:image/jpeg;base64,'.base64_encode($postContent['image'] ).'"/>
								</header>
								<article>
									<h1>'.$postContent['titel'].'</h1>
									<div class="postedBy">
									 	<img src="data:image/jpeg;base64,'.base64_encode($postContent['image'] ).'"/>
										'.$postContent['door'].' <br/>
										<time datetime="'.date('d-m-Y',strtotime($postContent['datum'])).'">'.date('d-m-Y',strtotime($postContent['datum'])).'</time>
									</div>
									<p>'.$postContent['bericht'].'</p>
								</article>
							</div>
						';
					}
				?>
			<? endif; ?>
		
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