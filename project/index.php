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
					$viewToggle 	= $_GET['viewToggle'] ? $_GET['viewToggle'] : 'all';
					$dateToggle 	= $_GET['dateToggle'] ? $_GET['dateToggle'] : 'week';
					$displayToggle 	= $_GET['displayToggle'] ? $_GET['displayToggle'] : 'bar';
			?>
			<div id="viewToggle">
				<ul id="mainToggle">
					<li><a href="?dateToggle=<?=$dateToggle?>&amp;viewToggle=all" <?=$viewToggle == 'all' ? 'class="active"' : ''?>><i class="fa fa-list-alt"></i></a></li>
					<li><a href="?dateToggle=<?=$dateToggle?>&amp;viewToggle=energy" <?=$viewToggle == 'energy' ? 'class="active"' : ''?>><i class="fa fa-plug"></i></a></li>
					<li><a href="?dateToggle=<?=$dateToggle?>&amp;viewToggle=water" <?=$viewToggle == 'water' ? 'class="active"' : ''?>><i class="fa fa-anchor"></i></a></li>
					<li><a href="?dateToggle=<?=$dateToggle?>&amp;viewToggle=gas" <?=$viewToggle == 'gas' ? 'class="active"' : ''?>><i class="fa fa-fire"></i></a></li>
				</ul>
			</div>

			<? if($viewToggle == 'all'): ?>
				<!-- all -->
				<div id="optionsToggle">
					<ul id="dateToggle">
						<li><a href="?dateToggle=dag&amp;displayToggle=<?=$displayToggle?>" <?=$dateToggle == 'dag' ? 'class="active"' : ''?>>Dag</a></li>
						<li><a href="?dateToggle=week&amp;displayToggle=<?=$displayToggle?>" <?=$dateToggle == 'week' ? 'class="active"' : ''?>>Week</a></li>
						<li><a href="?dateToggle=maand&amp;displayToggle=<?=$displayToggle?>" <?=$dateToggle == 'maand' ? 'class="active"' : ''?>>Maand</a></li>
						<li><a href="?dateToggle=jaar&amp;displayToggle=<?=$displayToggle?>" <?=$dateToggle == 'jaar' ? 'class="active"' : ''?>>Jaar</a></li>
					</ul>

					<ul id="displayToggle">
						<li><a href="?dateToggle=<?=$dateToggle?>&amp;displayToggle=area" <?=$displayToggle == 'area' ? 'class="active"' : ''?>><i class="fa fa-area-chart"></i></a></li>
						<li><a href="?dateToggle=<?=$dateToggle?>&amp;displayToggle=bar" <?=$displayToggle == 'bar' ? 'class="active"' : ''?>><i class="fa fa-bar-chart"></i></a></li>
					</ul>
				</div>

				<div id="dataDisplay">
					<!-- <div id="maxUse">max verbruik</div>
					<div id="minUse">min verbruik</div> -->
					<?
					$maxHeigt = 370;

					$energy 		= $maxHeigt * 0.33;
					$water 			= $maxHeigt * 0.33;
					$gas 			= $maxHeigt * 0.33;
					?>

					<div id="dates">
						<div id="maxUse">Max.</div>
						<div id="avgUse">Gem.</div>
						<ul>
							<?
								for($i == 1; $i < 7; $i++) {
									echo '
										<li>
											<div class="usages">
												<div class="energyUse" style="height:'.($energy-rand(5,50)).'px"><span>3.45 KwH</span></div>
												<div class="waterUse" style="height:'.($water-rand(5,50)).'px"><span>3.45 Liter</span></div>
												<div class="gasUse" style="height:'.($gas-rand(5,50)).'px"><span>3.45 KwH</span></div>
											</div>
											<div class=""></div>
											<span>'.($i+1).'</span>
										</li>
									';
								}
							?>
							
						</ul>
					</div>			
				</div>

				<div id="detailDisplays">
					<?
						function randomUse($dateToggle){
							$use = rand(400,1200)/100;
							if($dateToggle == 'dag') {
								$use = $use;
							} elseif($dateToggle == 'week') {
								$use = $use * 7;
							} elseif($dateToggle == 'maand') {
								$use = $use * 31;
							} elseif($dateToggle == 'jaar') {
								$use = $use * 365;
							}

							return number_format($use,2);
						}

						function randomCost($dateToggle) {
							return rand(500,2000)/100;
						}

						function randomPercentage() {
							return number_format(rand(100,1000)/100,1);
						}
						
					?>
					<ul>
						<li>
							<?
								detailDisplay('Energy', 'plug', randomUse($dateToggle), 120, 'kWh', randomCost(), $dateToggle, randomPercentage(), 'onder');
							?>
						</li>						
						<li>
							<?
								detailDisplay('Water', 'anchor', randomUse($dateToggle), 120, 'Liter', randomCost(), $dateToggle, randomPercentage(), 'onder');
							?>
						</li>						
						<li>
							<?
								detailDisplay('Gas', 'fire', randomUse($dateToggle), 120, 'kWh', randomCost(), $dateToggle, randomPercentage(), 'onder');
							?>
						</li>
					</ul>
				</div>
				<!-- end all -->

			<? elseif($viewToggle == 'energy'): ?>
				<div id="detailDataDisplay">
					<h1>Electriciteitsverbruik
						<span> vandaag, 
							<?
								echo date('d F Y')
							?>
						</span>
					</h1>

					<?
						detailDisplayInfo('Energy', 'plug', rand(400,1200)/100, 'kWh', number_format(rand(100,1000)/100,1), 'minder', rand(500,2000)/100);
					?>

				</div>
			<? elseif($viewToggle == 'water'): ?>
				<div id="detailDataDisplay">
					<h1>Waterverbruik
						<span> vandaag, 
							<?
								echo date('d F Y')
							?>
						</span>
					</h1>
				
					<?
						detailDisplayInfo('Water', 'anchor', rand(30,120)/100, 'Liter', rand(5,35), 'minder', rand(100,300)/100);
					?>
					
				</div>
			<? elseif($viewToggle == 'gas'): ?>
				<div id="detailDataDisplay">
					<h1>Gasverbruik
						<span> vandaag, 
							<?
								echo date('d F Y')
							?>
						</span>
					</h1>

					<?
						detailDisplayInfo('Gas', 'fire', rand(30,120)/100, 'kWh', rand(5,35), 'minder', rand(100,300)/100);
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
			addJS('static/js/functions.js');
		?>
    </body>
</html>