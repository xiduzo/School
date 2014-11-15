<?
include('includes/addFunctions.php');
include('includes/templates.php');
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Project 6, team l'epibré">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>De huishoud app | Home</title>
        <link rel="stylesheet" href="static/css/main.css">
        <link rel="author" href="L'epibré">
         <!-- font awesome -->
	    <link rel="stylesheet" href="static/font-awesome/css/font-awesome.min.css">
		<!--[if IE 7]>
		 	<link rel="stylesheet" href="static/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
    </head>
    <body>
    	<header id="mainHeader" class="inActiveNav">
			<div id="navButton"> <i class="fa fa-bars"></i> </div>
    	</header>

		<main  id="mainContent" class="inActiveNav">
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
					<li>Dag</li>
					<li class="active">Week</li>
					<li>Maand</li>
					<li>Jaar</li>
				</ul>

				<ul id="displayToggle">
					<li><i class="fa fa-area-chart"></i></li>
					<li class="active"><i class="fa fa-bar-chart"></i></li>
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
					<ul id="weekView">
						<li>
							<div class="usages">
								<div class="electricityUse" style="height:<?=$electricity-rand(5,50)?>px;"><span>3.45 KwH</span></div>
								<div class="waterUse" style="height:<?=$water-rand(5,50)?>px;"><span>3.45 Liter</span></div>
								<div class="gasUse" style="height:<?=$gas-rand(5,50)?>px;"><span>3.45 KwH</span></div>
							</div>
							<span>Ma</span>
						</li>
						<li>
							<div class="usages">
								<div class="electricityUse" style="height:<?=$electricity-rand(5,50)?>px;"><span>3.45 KwH</span></div>
								<div class="waterUse" style="height:<?=$water-rand(5,50)?>px;"><span>3.45 Liter</span></div>
								<div class="gasUse" style="height:<?=$gas-rand(5,50)?>px;"><span>3.45 KwH</span></div>
							</div>
							<span>Di</span>
						</li>
						<li>
							<div class="usages">
								<div class="electricityUse" style="height:<?=$electricity-rand(5,50)?>px;"><span>3.45 KwH</span></div>
								<div class="waterUse" style="height:<?=$water-rand(5,50)?>px;"><span>3.45 Liter</span></div>
								<div class="gasUse" style="height:<?=$gas-rand(5,50)?>px;"><span>3.45 KwH</span></div>
							</div>
							<span>Wo</span>
						</li>
						<li>
							<div class="usages">
								<div class="electricityUse" style="height:<?=$electricity-rand(5,50)?>px;"><span>3.45 KwH</span></div>
								<div class="waterUse" style="height:<?=$water-rand(5,50)?>px;"><span>3.45 Liter</span></div>
								<div class="gasUse" style="height:<?=$gas-rand(5,50)?>px;"><span>3.45 KwH</span></div>
							</div>
							<span>Do</span>
						</li>
						<li>
							<div class="usages">
								<div class="electricityUse" style="height:<?=$electricity-rand(5,50)?>px;"><span>3.45 KwH</span></div>
								<div class="waterUse" style="height:<?=$water-rand(5,50)?>px;"><span>3.45 Liter</span></div>
								<div class="gasUse" style="height:<?=$gas-rand(5,50)?>px;"><span>3.45 KwH</span></div>
							</div>
							<span>Vr</span>
						</li>
						<li>
							<div class="usages">
								<div class="electricityUse" style="height:<?=$electricity-rand(5,50)?>px;"><span>3.45 KwH</span></div>
								<div class="waterUse" style="height:<?=$water-rand(5,50)?>px;"><span>3.45 Liter</span></div>
								<div class="gasUse" style="height:<?=$gas-rand(5,50)?>px;"><span>3.45 KwH</span></div>
							</div>
							<span>Za</span>
						</li>
						<li>
							<div class="usages">
								<div class="electricityUse" style="height:<?=$electricity-rand(5,50)?>px;"><span>3.45 KwH</span></div>
								<div class="waterUse" style="height:<?=$water-rand(5,50)?>px;"><span>3.45 Liter</span></div>
								<div class="gasUse" style="height:<?=$gas-rand(5,50)?>px;"><span>3.45 KwH</span></div>
							</div>
							<span>Zo</span>
						</li>
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
							<div class="percentage">U verbruikt 2px onder het gemiddelde <i class="fa fa-arrow-circle-o-down"></i></div>
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
							<div class="percentage">U verbruikt 2px onder het gemiddelde <i class="fa fa-arrow-circle-o-down"></i></div>
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
							<div class="percentage">U verbruikt 2px onder het gemiddelde <i class="fa fa-arrow-circle-o-down"></i></div>
						</div>
					</li>
				</ul>
			</div>
		</main>

		<nav id="mainNavigation">
			<div id="whoIs">Jan Groot</div>

			<ul>
				<li>
					<a href="#1">
						<i class="fa fa-th"></i>
						Verbruik overzicht
					</a>
				</li>
				<li class="activeNavItem">
					<a href="#2">
						<i class="fa fa-indent"></i>
						Mijn verbruik
					</a>
				</li>
				<li>
					<a href="#2">
					<i class="fa fa-comment"></i>
					Community
				</a>
				</li>
				<li>
					<a href="#2">
						<i class="fa fa-exclamation-circle"></i>
						Mijn betalingen
					</a>
				</li>
				<li>
					<a href="#2">
						<i class="fa fa-align-center"></i>
						Mijn bespaardoelen
					</a>
				</li>
			</ul>

			<ul>
				<li>
					<a href="#1">
						<i class="fa fa-user"></i>
						Meterstand doorgeven
					</a>
				</li>
				<li>
					<a href="#2">
						<i class="fa fa-book"></i>
						Log uit
					</a>
				</li>
			</ul>

		</nav>

		<!-- extern -->
		<script src="static/js/extern/hammer.min.js"></script>
		<script src="static/js/extern/jquery-1.7.1.min.js"></script>

		<!-- self -->
		<script src="static/js/functions.js"></script>
    </body>
</html>