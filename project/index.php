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
    		head('Home');

	        addCSS('static/css/main.css');
	        //font awesome
	        addCSS('static/font-awesome/css/font-awesome.min.css');
        ?>
    </head>
    <body>
    	<script type="text/javascript">
    		$(function() {
			    document.documentElement.requestFullscreen();
			});
    	</script>
    	<?
    		pageHeader();
    	?>

		<main  id="mainContent">
		<div id="background"></div>
		<?
		$savingGoal 	= 149.99;
		$days 			= 365 * 1.5;
		$randomPercent 	= rand(49, 83);
		$randomSaving  	= ($savingGoal * $randomPercent) / 100;
		?>
		<section id="indexSection">
			<div id="donut" data-donut="<?=$randomPercent?>" data-saving="<?=$randomSaving?>">
				<img src="http://www.jamet.nl/file646.jpg" alt="vouwwagen">
				<!-- <div id="saving"><div id="euroSaving">&euro;00.00</div><span>bespaard</span></div> -->
				<div id="saving">
					Uw doel: <br/> 
					<span>&euro;<?=round($savingGoal);?></span> binnen <span><?=round($days);?></span> dagen <br/>
					Huidige besparing: <br/>
					<span>&euro;<?=number_format($randomSaving,2);?></span> in <span><?=round($days*$randomPercent/100)?></span> dagen
				</div>
			</div>
		</section>

		<section id="callToActionSection">
			<article>	
				<p>
					<span>Beste <?=$user['voorNaam']?>,</span> <br/>
					Uw doel is haalbaar als u op deze manier blijft besparen. U bespaart nu: <br/>
				</p>
				<ul>
					<li>
						Per week
						<span>&euro;<? echo number_format(rand(200,400)/100,2) ?></span>
					</li>
					<li>
						Per maand
						<span>&euro;<? echo number_format(rand(800,1500)/100,2) ?></span>
					</li>
					<li>
						Per jaar
						<span>&euro;<? echo number_format(rand(9500,11000)/100,2) ?></span>
					</li>
				</ul>
			</article>
			<article>
				<p>
					<span>Persoonlijke bespaartips</span> <br/>
					Uw verbruikt veel <em>water</em>. De beste manier om hierop te besparen is:
				</p>

				<p>
					Nieuwe afwasmachine nodig? Koop de zuinigste <br/>
					<i class="fa fa-money"></i> <em>&euro;4,00</em>
				</p>
				<button onClick="location.href='/school/project/bespaartips.php'">Ik wil meer besparen</button>
			</article>
		</section>

		<section id="detailUseSection">
			<div id="showDetailButton"><i class="fa fa-chevron-up"></i> Bekijk de details van je gebruik <i class="fa fa-chevron-up"></i></div>
			<div id="detailDisplays">
				<ul>
					<!-- http://www.nibud.nl/uitgaven/huishouden/gas-elektriciteit-en-water.html -->
					<?
						// detailUse($icon, $what, $price, $use, $useType, $percent, $moreOrLess)
						detailUse(
							'fire', 
							'gas', 
							number_format(rand(7000,8000)/100,2), 
							number_format(rand(8000,10000)/100,2), 
							'm³', 
							5, 
							'minder'
						);
						detailUse(
							'plug', 
							'Electriciteit', 
							number_format(rand(2500,3500)/100,2), 
							number_format(rand(16000,17500)/100,2), 
							'kWh', 
							8, 
							'minder'
						);
						detailUse(
							'tint', 
							'Water', 
							number_format(rand(800,1300)/100,2), 
							number_format(rand(370000,380000)/100,2), 
							'Liter', 
							5, 
							'meer'
						);
					?>
				</ul>
			</div>
		</section>

		</main>

		<?
			$userName = $user['voorNaam']." ".$user['achterNaam'];
			mainNavigation($userName, 'home');
		?>

		<!-- JS scripts -->
		<?
			// Extern
			addJS('static/js/extern/hammer.min.js');
			addJS('static/js/extern/jquery-1.7.1.min.js');
			addJS('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
			addJS('http://d3js.org/d3.v3.min.js');

			// Self
			addJS('static/js/menuToggle.js');
			addJS('static/js/detailViewToggle.js');
			addJS('static/js/donut.js');
		?>
    </body>
</html>