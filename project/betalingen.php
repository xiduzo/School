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
					<span>&euro;10.13</span> bespaard
				</li>
				<li>
					<h1>December 2014</h1>
					<span>&euro;9.65</span> bespaard
				</li>
				<li>
					<h1>November 2014</h1>
					<span>&euro;10.35</span> bespaard
				</li>
				<li>
					<h1>Oktober 2014</h1>
					<span>&euro;12.58</span> bespaard
				</li>
				<li>
					<h1>Augustus 2014</h1>
					<span>&euro;13.15</span> bespaard
				</li>
				<li>
					<h1>Juli 2014</h1>
					<span>&euro;9.80</span> bespaard
				</li>
				<li>
					<h1>Juni 2014</h1>
					<span>&euro;13.83</span> bespaard
				</li>
				<li>
					<h1>Mei 2014</h1>
					<span>&euro;10.36</span> bespaard
				</li>
				<li>
					<h1>April 2014</h1>
					<span>&euro;9.43</span> bespaard
				</li>
				<li>
					<h1>Maart 2014</h1>
					<span>&euro;8.79</span> bespaard
				</li>
				<li>
					<h1>Februari 2014</h1>
					<span>&euro;8.15</span> bespaard
				</li>
				<li>
					<h1>Januari 2014</h1>
					<span>&euro;7.36</span> bespaard
				</li>
			</ul>
		</section>

		<section id="betalingenDetail">
			<section>
				<h1>Januari 2015</h1>
				Uw verbruik en besparing

				<ul>
					<li>
						<span>&euro;148.00</span> verbruikt
					</li>
					<li>
						<span>&euro;10.13</span> bespaard
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
			$('#betalingen ul li').click(function() {
				$(this).siblings('.active').removeClass('active');
				$(this).addClass('active');
			});
		</script>

    </body>
</html>