<?
session_start();

include 'includes/addFunctions.php';
include 'includes/templates.php';
include 'includes/checks.php';

//checkUser();
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
			<div id="viewToggle">
				<ul>
					<li class="active"><i class="fa fa-list-ul"></i></li>
					<li><i class="fa fa-bolt"></i></li>
					<li><i class="fa fa-anchor"></i></li>
					<li><i class="fa fa-database"></i></li>
				</ul>
			</div>

			<div id="optionsToggle">
				<ul id="dateToggle">
				<?
					$dateToggle = $_GET['dateToggle'];
					$displayToggle = $_GET['displayToggle'];
				?>
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

				$electricity 	= $maxHeigt * 0.33;
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
											<div class="electricityUse" style="height:'.($electricity-rand(5,50)).'px"><span>3.45 KwH</span></div>
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
						<div class="circleDetail" id="circelElectricity"><i class="fa fa-bolt"></i></div>
						<div class="usage">
							<div class="realUse">
								<em id="realElectricity">3.45</em>/12 <br/>
								<span>totaal verbruik (KwH)</span>
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
								<span>totaal verbruik (KwH)</span>
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
		</main>

		<?
			mainNavigation('Jan Groot', 'verbruik');
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