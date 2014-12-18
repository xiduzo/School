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
			<header>
				<ul>
					<li>
						Week
						<span>&euro;<? echo number_format(rand(100,500)/100,2) ?></span>
					</li>
					<li>
						Maand
						<span>&euro;<? echo number_format(rand(2000,5000)/100,2) ?></span>
					</li>
					<li>
						Jaar
						<span>&euro;<? echo number_format(rand(10000,20000)/100,2) ?></span>
					</li>
				</ul>
			</header>
			<article>
				<p>
					Beste <?=$user['voorNaam']?>, <br/>
					Dit is jouw persoonlijke besparing op: <br/>
					<span><? echo date('d F Y, H:i',strtotime("now")) ?></span>
				</p>
				<button>Ik wil meer besparen</button>
			</article>
		</section>

		<section id="detailUseSection">
			<div id="showDetailButton"><i class="fa fa-chevron-up"></i> Bekijk je verbruik details <i class="fa fa-chevron-up"></i></div>
			<div id="detailDisplays">
				<ul>
					<li>
						<a href="/school/project/detailDisplay.php?viewToggle=energy">
							<header class="energy"></header>
							<i class="fa fa-plug"></i>
							<h1>Electriciteit</h1>
							<div class="expense">
								&euro;<? echo number_format(rand(3000,5000)/100,2) ?>
							</div>
							<div class="use">
								<? echo number_format(rand(30000,50000)/100,2) ?> kWh
							</div>
							<div class="percent">
								% minder <i class="fa fa-arrow-circle-o-down"></i>
							</div>
						</a>

					</li>						
					<li>
						<a href="/school/project/detailDisplay.php?viewToggle=water">
							<header class="water"></header>
							<i class="fa fa-tint"></i>
							<h1>Water</h1>
							<div class="expense">
								&euro;<? echo number_format(rand(1000,2000)/100,2) ?>
							</div>
							<div class="use">
								<? echo number_format(rand(10000,20000)/100,2) ?> Liter
							</div>
							<div class="percent">
								% minder <i class="fa fa-arrow-circle-o-down"></i>
							</div>
						</a>
					</li>						
					<li>
						<a href="/school/project/detailDisplay.php?viewToggle=gas">
							<header class="gas"></header>
							<i class="fa fa-fire"></i>
							<h1>Gas</h1>
							<div class="expense">
								&euro;<? echo number_format(rand(3000,5000)/100,2) ?>
							</div>
							<div class="use">
								<? echo number_format(rand(30000,50000)/100,2) ?> kWh
							</div>
							<div class="percent">
								% meer <i class="fa fa-arrow-circle-o-up"></i>
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