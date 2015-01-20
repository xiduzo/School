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
		<div id="background"></div>
		<?
		$savingGoal 	= 400.32;
		$randomPercent 	= rand(5, 95);
		$randomSaving  	= ($savingGoal * $randomPercent) / 100;
		?>
		<section id="indexSection">
			<div id="donut" data-donut="<?=$randomPercent?>" data-saving="<?=$randomSaving?>">
			<img src="http://www.vouwwagenpunt.nl/wp-content/uploads/2012/02/Wolder-hogar1-vouwwagen1.jpg" alt="vouwwagen">
			<div id="saving"><div id="euroSaving">&euro;00.00</div><span>bespaard</span></div>
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
						<span>&euro;<? echo number_format(rand(100,300)/100,2) ?></span>
					</li>
					<li>
						Per maand
						<span>&euro;<? echo number_format(rand(1000,1800)/100,2) ?></span>
					</li>
					<li>
						Per jaar
						<span>&euro;<? echo number_format(rand(5000,10000)/100,2) ?></span>
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
					<i class="fa fa-money"></i> &euro;4,00
				</p>
				<button onClick="location.href='/school/project/community.php'">Ik wil meer besparen</button>
			</article>
		</section>

		<section id="detailUseSection">
			<div id="showDetailButton"><i class="fa fa-chevron-up"></i> Bekijk de details van je gebruik <i class="fa fa-chevron-up"></i></div>
			<div id="detailDisplays">
				<ul>
					<!-- http://www.nibud.nl/uitgaven/huishouden/gas-elektriciteit-en-water.html -->					
					<li>
						<a href="/school/project/detailDisplay.php?viewToggle=gas">
							<i class="fa fa-fire"></i>
							<h1>Gas</h1>
							Totaal verbruik deze maand:
							<div class="expense">
								&euro;<? echo number_format(rand(7000,8000)/100,2) ?>
							</div>
							<div class="use">
								(<? echo number_format(rand(8000,10000)/100,2) ?> m³)
							</div>
							<div class="percent">
								% meer <i class="fa fa-arrow-circle-o-up"></i>
							</div>
						</a>
					</li>
					<li>
						<a href="/school/project/detailDisplay.php?viewToggle=energy">
							<i class="fa fa-plug"></i>
							<h1>Electriciteit</h1>
							Totaal verbruik deze maand:
							<div class="expense">
								&euro;<? echo number_format(rand(2500,3500)/100,2) ?>
							</div>
							<div class="use">
								(<? echo number_format(rand(16000,17500)/100,2) ?> kWh)
							</div>
							<div class="percent">
								% minder <i class="fa fa-arrow-circle-o-down"></i>
							</div>
						</a>

					</li>						
					<li>
						<a href="/school/project/detailDisplay.php?viewToggle=water">
							<i class="fa fa-tint"></i>
							<h1>Water</h1>
							Totaal verbruik deze maand:
							<div class="expense">
								&euro;<? echo number_format(rand(800,1300)/100,2) ?>
							</div>
							<div class="use">
								(<? echo number_format(rand(370000,380000)/100,2) ?> Liter)
							</div>
							<div class="percent">
								% minder <i class="fa fa-arrow-circle-o-down"></i>
							</div>
						</a>
					</li>
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