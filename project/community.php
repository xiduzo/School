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


		<button id="newTip" onclick="addNewTip()"><i class="fa fa-plus"></i></button>

		<div id="newTipScreen">
			<section id="newTipVisableScreen">
				<button id="closeTipScreen" onclick="closeNewTipScreen()"><i class="fa fa-close"></i></button>
				<h1>Schrijf je tip</h1>
				<p>Deel je besparingstips met andere gebruikers. En hier nog wat tekst waarom het handig is.</p>
				<form id="tipForm" method="post" action="<?=$_SERVER['PHP_SELF']?>">
					
					Titel:<br/>
					<input type="text" name="title" placeholder="Vul hier een titel in">
					Uw besparingstip:<br/>
					<textarea name="tip"></textarea>

					<input id="addTip" type="submit" value="Verstuur tip" name="addTip">
				</form>
			</section>
		</div>

		<script type="text/javascript">
			function addNewTip() {
				$("#newTipScreen").toggleClass("active");
			}

			function closeNewTipScreen() {
				$("#newTipScreen").toggleClass("active");
			}
		</script>

		<main  id="mainContent">

			<?
				$viewToggle 	= $_GET['viewToggle'] ? $_GET['viewToggle'] : 'all';
				$allPosts 		= getPosts($viewToggle);
			?>
			<div id="viewToggle">

				<ul id="forumToggle">
					<li><a href="?viewToggle=all" <?=$viewToggle == 'all' ? 'class="active"' : ''?>>Alle berichten<span><?echo mysqli_num_rows(getPosts('all'))?></span></a></li>
					<li><a href="?viewToggle=corp" <?=$viewToggle == 'corp' ? 'class="active"' : ''?>>WoningCorp. berichten<span><?echo mysqli_num_rows(getPosts('corp'))?></span></a></li>
					<li><a href="?viewToggle=tips" <?=$viewToggle == 'tips' ? 'class="active"' : ''?>>Besparingstips<span><?echo mysqli_num_rows(getPosts('tips'))?></span></a></li>
				</ul>
			</div>

			<div id="posts">
				<?
					while($post = mysqli_fetch_array($allPosts)){
						if($post['type'] == 1){
							echo '
								<a href="detailPost.php?postID='.$post['id'].'">
									<div class="post">
										<header>
										<img src="data:image/jpeg;base64,'.base64_encode($post['image'] ).'"/>
										</header>
										<article>
											<h1>'.$post['titel'].'</h1>
											<div class="postedBy">
											 	<img src="data:image/jpeg;base64,'.base64_encode($post['image'] ).'"/>
												'.$post['door'].' <br/>
												<time datetime="'.date('d-m-Y',strtotime($post['datum'])).'">'.date('d-m-Y',strtotime($post['datum'])).'</time>
											</div>
											<p>'.$post['bericht'].'</p>
										</article>
									</div>
								</a>
							';
						} else {
							echo '
								<a href="detailPost.php?postID='.$post['id'].'">
									<div class="post">
										<article>
											<h1>'.$post['titel'].'</h1>
											<div class="postedBy">
											 	<img src="data:image/jpeg;base64,'.base64_encode($post['image'] ).'"/>
												'.$post['door'].' <br/>
												<time datetime="'.date('d-m-Y',strtotime($post['datum'])).'">'.date('d-m-Y',strtotime($post['datum'])).'</time>
											</div>
											<p>'.$post['bericht'].'</p>
										</article>
									</div>
								</a>
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
			addJS('static/js/menuToggle.js');
		?>
    </body>
</html>