<?

function head($title){
	echo '
        <meta charset="utf-8">
        <meta name="description" content="Project 6, team l\'epibré">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
        <title>De huishoud app | '.$title.'</title>
        <link rel="author" href="L\'epibré">
        <link rel="icon" type="image/ico" href="/favicon.ico"/>
    ';
}

function pageHeader() {
	echo '
		<header id="mainHeader">
			<div id="navButton"> <i class="fa fa-bars"></i> </div>
			<div id="logo"></div>
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
				<li class="'. (($activePage == "home") ? $active : $inActive ) .'">
					<a href="/school/project/index.php">
						<i class="fa fa-home"></i>
						Home
					</a>
				</li>
				<li class="'. (($activePage == "tips") ? $active : $inActive ) .'">
					<a href="/school/project/bespaartips.php">
						<i class="fa fa-tags"></i>
						Bespaartips
					</a>
				</li>
			</ul>

			<ul>
				<li class="'. (($activePage == "betalingen") ? $active : $inActive ) .'">
					<a href="/school/project/betalingen.php">
						<i class="fa fa-folder-open"></i>
						Mijn betalingen
					</a>
				</li>
				<li class="'. (($activePage == "corporatie") ? $active : $inActive ) .'">
					<a href="/school/project/corporatie.php">
						<i class="fa fa-newspaper-o"></i>
						Mijn wooncorporatie <span>4</span>
					</a>
				</li>
				<li class="'. (($activePage == "bespaardoel") ? $active : $inActive ) .'">
					<a href="/school/project/bespaardoel.php">
						<i class="fa fa-sliders"></i>
						Mijn bespaardoel
					</a>
				</li>
			</ul>

			<ul>
				<li class="'. (($activePage == "loguit") ? $active : $inActive ) .'">
					<a href="/school/project/logout.php">
						<i class="fa fa-power-off"></i>
						Log uit
					</a>
				</li>
			</ul>
		</nav>
	';
}

function detailUse($icon, $what, $price, $use, $useType, $percent, $moreOrLess) {
	switch ($moreOrLess) {
		case 'meer':
			$icon2 = 'up';
			break;
		
		default:
			$icon2 = 'down';
			break;
	}
	echo '
		<li>
			<i class="fa fa-'.$icon.'"></i>
			<h1>'.$what.'</h1>
			Totaal verbruik deze maand:
			<div class="expense">
				&euro;'.$price.'
			</div>
			<div class="use">
				('.$use.' '.$useType.')
			</div>
			<div class="percent">
				<span>U verbruikt '.$percent.'% '.$moreOrLess.' dan andere gebruikers</span> <i class="fa fa-arrow-circle-o-'.$icon2.'"></i>
			</div>
		</li>
	';
}

function showTip($titel, $tip, $omdat, $besparing) {
	echo '
		<li>
			<article>
				<h1>'.$titel.'</h1>
				<p>
					'.$tip.'
				</p>
				<p>
					<span>Waarom?</span>
					'.$omdat.'
				</p>
				<div id="saving">
					<i class="fa fa-money"></i>&euro;'.$besparing.'
				</div>
			</article>
		</li>
	';
}

?>