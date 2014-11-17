<?

function head($title){
	echo '
        <meta charset="utf-8">
        <meta name="description" content="Project 6, team l\'epibré">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>De huishoud app | '.$title.'</title>
        <link rel="author" href="L\'epibré">
    ';
}

function pageHeader() {
	echo '
		<header id="mainHeader">
			<div id="navButton"> <i class="fa fa-bars"></i> </div>
			<div id="appName">De huishoud app</div>
    	</header>
	';
}

function mainNavigation($whoIs, $activePage) {
	$active 	= "activeNavItem";
	$inActive 	= "inActiveNavItem";
	echo '
		<nav id="mainNavigation">
			<div id="whoIs">'.$whoIs.'</div>

			<ul>
				<li class="'. (($activePage == "overzicht") ? $active : $inActive ) .'">
					<a href="#overzicht">
						<i class="fa fa-th"></i>
						Verbruik overzicht
					</a>
				</li>
				<li class="'. (($activePage == "verbruik") ? $active : $inActive ) .'">
					<a href="#verbruik">
						<i class="fa fa-indent"></i>
						Mijn verbruik
					</a>
				</li>
				<li class="'. (($activePage == "community") ? $active : $inActive ) .'">
					<a href="#community">
					<i class="fa fa-comment"></i>
					Community
				</a>
				</li>
				<li class="'. (($activePage == "betalingen") ? $active : $inActive ) .'">
					<a href="#betalingen">
						<i class="fa fa-exclamation-circle"></i>
						Mijn betalingen
					</a>
				</li>
				<li class="'. (($activePage == "bespaardoelen") ? $active : $inActive ) .'">
					<a href="#bespaardoelen">
						<i class="fa fa-align-center"></i>
						Mijn bespaardoelen
					</a>
				</li>
			</ul>

			<ul>
				<li class="'. (($activePage == "meterstand") ? $active : $inActive ) .'">
					<a href="#meterstand">
						<i class="fa fa-user"></i>
						Meterstand doorgeven
					</a>
				</li>
				<li class="'. (($activePage == "loguit") ? $active : $inActive ) .'">
					<a href="/school/project/logout.php">
						<i class="fa fa-book"></i>
						Log uit
					</a>
				</li>
			</ul>
		</nav>
	';
}

?>