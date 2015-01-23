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
    		head('Betalingen');

	        addCSS('static/css/main.css');
	        //font awesome
	        addCSS('static/font-awesome/css/font-awesome.min.css');
        ?>
    </head>
    <body>
    	<?
    		pageHeader();
    	?>

		<main id="mainContent">
		<div id="background"></div>

		<section id="betalingen">
			<ul>
				<li class="active">
					<h1>Januari 2015</h1>
					<span>&euro;<div class="saved">10.13</div></span> bespaard
				</li>
				<li>
					<h1>December 2014</h1>
					<span>&euro;<div class="saved">9.65</div></span> bespaard
				</li>
				<li>
					<h1>November 2014</h1>
					<span>&euro;<div class="saved">10.35</div></span> bespaard
				</li>
				<li>
					<h1>Oktober 2014</h1>
					<span>&euro;<div class="saved">12.58</div></span> bespaard
				</li>
				<li>
					<h1>Augustus 2014</h1>
					<span>&euro;<div class="saved">13.15</div></span> bespaard
				</li>
				<li>
					<h1>Juli 2014</h1>
					<span>&euro;<div class="saved">9.80</div></span> bespaard
				</li>
				<li>
					<h1>Juni 2014</h1>
					<span>&euro;<div class="saved">13.83</div></span> bespaard
				</li>
				<li>
					<h1>Mei 2014</h1>
					<span>&euro;<div class="saved">10.36</div></span> bespaard
				</li>
				<li>
					<h1>April 2014</h1>
					<span>&euro;<div class="saved">9.43</div></span> bespaard
				</li>
				<li>
					<h1>Maart 2014</h1>
					<span>&euro;<div class="saved">8.79</div></span> bespaard
				</li>
				<li>
					<h1>Februari 2014</h1>
					<span>&euro;<div class="saved">8.15</div></span> bespaard
				</li>
				<li>
					<h1>Januari 2014</h1>
					<span>&euro;<div class="saved">7.36</div></span> bespaard
				</li>
			</ul>
		</section>

		<section id="betalingenDetail">
			<section>
				<h1>Januari 2015</h1>
				Uw verbruik en besparing

				<ul>
					<li>
						<span>&euro;<div id="used"></div></span> verbruikt
					</li>
					<li>
						<span>&euro;<div id="saving"></div></span> bespaard
					</li>
				</ul>
			</section>
				
			<section>
			</section>
		</section>
		</main>

		<?
			$userName = $user['voorNaam']." ".$user['achterNaam'];
			mainNavigation($userName, 'betalingen');
		?>

		<!-- JS scripts -->
		<?
			// Extern
			addJS('static/js/extern/hammer.min.js');
			addJS('static/js/extern/jquery-1.7.1.min.js');

			// Self
			addJS('static/js/menuToggle.js');
		?>
		<script>
			// Last minute jQuery because hammerJS is new (for me) and can't fix it as fast as with jQuery (FORGIVE ME!)
			
			// This took me a while but im proud of it!
			var base = 194.50;
			var saving = $('.active').find('.saved').text();
			var use = (base - saving).toFixed(2);
			$('#saving').html(saving);

			$('#used').html(use);

			$('#betalingen ul li').click(function() {
				$(this).siblings('.active').removeClass('active');
				$(this).addClass('active');

				// So it works with click \0/ (update vieuw)
				var saving = $(this).find('.saved').text();
				$('#saving').html(saving);

				var use = (base - saving).toFixed(2);
				$('#used').html(use);
			});
		</script>

    </body>
</html>