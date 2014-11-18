<?
session_start();

include 'includes/addFunctions.php';
include 'includes/getFunctions.php';
include 'includes/templates.php';
include 'includes/checks.php';

checkUser();

if($_SESSION['user']){
	$user = getUser($_SESSION['user']);
}

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
				<ul>
					<li><a href="?dateToggle=<?=$dateToggle?>&viewToggle=all" <?=$viewToggle == 'all' ? 'class="active"' : ''?>><i class="fa fa-list-ul"></i></a></li>
					<li><a href="?dateToggle=<?=$dateToggle?>&viewToggle=energy" <?=$viewToggle == 'energy' ? 'class="active"' : ''?>><i class="fa fa-bolt"></i></a></li>
					<li><a href="?dateToggle=<?=$dateToggle?>&viewToggle=water" <?=$viewToggle == 'water' ? 'class="active"' : ''?>><i class="fa fa-anchor"></i></a></li>
					<li><a href="?dateToggle=<?=$dateToggle?>&viewToggle=gas" <?=$viewToggle == 'gas' ? 'class="active"' : ''?>><i class="fa fa-database"></i></a></li>
				</ul>
			</div>

			<? if($viewToggle == 'all'): ?>
				<!-- all -->
				<div id="optionsToggle">
					<ul id="dateToggle">
						<li><a href="?dateToggle=day&displayToggle=<?=$displayToggle?>" <?=$dateToggle == 'day' ? 'class="active"' : ''?>>Dag</a></li>
						<li><a href="?dateToggle=week&displayToggle=<?=$displayToggle?>" <?=$dateToggle == 'week' ? 'class="active"' : ''?>>Week</a></li>
						<li><a href="?dateToggle=month&displayToggle=<?=$displayToggle?>" <?=$dateToggle == 'month' ? 'class="active"' : ''?>>Maand</a></li>
						<li><a href="?dateToggle=year&displayToggle=<?=$displayToggle?>" <?=$dateToggle == 'year' ? 'class="active"' : ''?>>Jaar</a></li>
					</ul>

					<ul id="displayToggle">
						<li><a href="?dateToggle=<?=$dateToggle?>&displayToggle=area" <?=$displayToggle == 'area' ? 'class="active"' : ''?>><i class="fa fa-area-chart"></i></a></li>
						<li><a href="?dateToggle=<?=$dateToggle?>&displayToggle=bar" <?=$displayToggle == 'bar' ? 'class="active"' : ''?>><i class="fa fa-bar-chart"></i></a></li>
					</ul>
				</div>

				<div id="dataDisplay">
					<!-- <div id="maxUse">max verbruik</div>
					<div id="minUse">min verbruik</div> -->
					<?
					$maxHeigt = 370;

					$energy 	= $maxHeigt * 0.33;
					$water 			= $maxHeigt * 0.33;
					$gas 			= $maxHeigt * 0.33;
					?>

					<div id="dates">
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
											<span>'.($i+1).'</span>
										</li>
									';
								}
							?>
							
						</ul>
					</div>			
				</div>

				<div id="detailDisplays">
					<ul>
						<li>
							<div class="circleDetail" id="circelEnergy"><i class="fa fa-bolt"></i></div>
							<div class="usage">
								<div class="realUse">
									<em id="realEnergy">3.45</em>/12 <br/>
									<span>totaal verbruik (kWh)</span>
								</div>
								<div class="toEuros">
									&euro; 3.04 <br/>
									<span>Kosten per week</span>
								</div>
								<div class="percentage">U verbruikt 2% onder het gemiddelde <i class="fa fa-arrow-circle-o-down"></i></div>
							</div>
						</li>

						<li>
							<div class="circleDetail" id="circelWater"><i class="fa fa-anchor"></i></div>
							<div class="usage">
								<div class="realUse">
									<em id="realWater">3.45</em>/12 <br/>
									<span>totaal verbruik (kWh)</span>
								</div>
								<div class="toEuros">
									&euro; 3.04 <br/>
									<span>Kosten per week</span>
								</div>
								<div class="percentage">U verbruikt 2% onder het gemiddelde <i class="fa fa-arrow-circle-o-down"></i></div>
							</div>
						</li>

						<li>
							<div class="circleDetail" id="circelGas"><i class="fa fa-database"></i></div>
							<div class="usage">
								<div class="realUse">
									<em id="realGas">3.45</em>/12 <br/>
									<span>totaal verbruik (Liter)</span>
								</div>
								<div class="toEuros">
									&euro; 3.04 <br/>
									<span>Kosten per week</span>
								</div>
								<div class="percentage">U verbruikt 2% onder het gemiddelde <i class="fa fa-arrow-circle-o-down"></i></div>
							</div>
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

					<div id="detailDisplayInfo">
						<div class="circleDetail" id="circelEnergy"><i class="fa fa-bolt"></i></div>
						Verbruik <span>3.45 kWh</span>
					</div>
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
				
					<div id="detailDisplayInfo">
						<div class="circleDetail" id="circelWater"><i class="fa fa-anchor"></i></div>
						Verbruik <span>3.45 Liter</span>
					</div>
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

					<div id="detailDisplayInfo">
						<div class="circleDetail" id="circelGas"><i class="fa fa-database"></i></div>
						Verbruik <span>3.45 kWh</span>
					</div>
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