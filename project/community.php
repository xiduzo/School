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
				$allPosts 		= getPosts($viewToggle);
			?>
			<div id="viewToggle">

				<button id="newTip"><a href="#nieuweTip"><i class="fa fa-plus"></i></a></button>

				<ul id="forumToggle">
					<li><a href="?viewToggle=all" <?=$viewToggle == 'all' ? 'class="active"' : ''?>>Alle berichten<span><?echo mysqli_num_rows(getPosts('all'))?></span></a></li>
					<li><a href="?viewToggle=corp" <?=$viewToggle == 'corp' ? 'class="active"' : ''?>>WoningCorp. berichten<span><?echo mysqli_num_rows(getPosts('corp'))?></span></a></li>
					<li><a href="?viewToggle=tips" <?=$viewToggle == 'tips' ? 'class="active"' : ''?>>Besparingstips<span><?echo mysqli_num_rows(getPosts('tips'))?></span></a></li>
				</ul>
			</div>

			<div id="posts">
				<?
					while($post = mysqli_fetch_array($allPosts)){
						$opacity = $post['reader'] == 1 ? 'opacity:.7;' : 'opacity:1;';
						if($post['type'] == 1){
							echo '
								<div class="post" style="'.$opacity.'">
									<header>
									<img src="data:image/jpeg;base64,'.base64_encode( $post['image'] ).'"/>
									</header>
									<article>
										<h1>'.$post['titel'].'</h1>
										<div class="postedBy">
										 	<img src="data:image/jpeg;base64,'.base64_encode( $post['image'] ).'"/>
											'.$post['door'].' <br/>
											<time datetime="'.date('d-m-Y',strtotime($post['datum'])).'">'.date('d-m-Y',strtotime($post['datum'])).'</time>
										</div>
										<p>'.$post['bericht'].'</p>
									</article>
								</div>
							';
						} else {
							echo '
								<div class="post" style="'.$opacity.'">
									<article>
										<h1>'.$post['titel'].'</h1>
										<div class="postedBy">
										 	<img src="data:image/jpeg;base64,'.base64_encode( $post['image'] ).'"/>
											'.$post['door'].' <br/>
											<time datetime="'.date('d-m-Y',strtotime($post['datum'])).'">'.date('d-m-Y',strtotime($post['datum'])).'</time>
										</div>
										<p>'.$post['bericht'].'</p>
									</article>
								</div>
							';
						}
					}
				?>
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