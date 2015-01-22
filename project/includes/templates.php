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

// function detailDisplay($header, $icon, $what, $cost, $use, $measure, $percent, $moreOrLess) {
// 	$iconUse = $moreOrLess == 'meer' ? 'up' : 'down';
// 	echo '
// 		<header class="'.$header.'"></header>
// 		<i class="fa fa-'.$icon.'></i>
// 		<h1>'.$what.'</h1>
// 		<div class="expense">
// 			&euro;'.$cost.'
// 		</div>
// 		<div class="use">
// 			'.$use.' '.$measure.'
// 		</div>
// 		<div class="percent">
// 			'.$percent.' '.$moreOrLess.' <i class="fa fa-arrow-circle-o-'.$iconUse.'"></i>
// 		</div>
// 	';
// }

function detailDisplayInfo($what, $percentage, $moreOrLess, $amoundSaved) {
	echo '
		<h1>'.$what.'verbruik
			<span> vandaag,
					'.date('d F Y').'
			</span>
		</h1>
		<div id="detailDisplayInfo">
			<ul>
				<li>
					<div id="usagePercentageCompare"><i class="fa fa-pie-chart"></i></div>
					<div id="usageCompare">
						Verbruik t.o.v. het gemiddelde <br/>
						<span>'.$percentage.'% '.$moreOrLess.'</span>
					</div>
				</li>
				<li>
					<div id="moneySaved"><i class="fa fa-money"></i></div>
					<div class="usageSaving">
						Totale besparing <br/>
						<span>&euro; '.number_format($amoundSaved, 2).'</span>
					</div>
					<div class="usageSaving">
						Totale besparing op maandbasis &sup1;<br/>
						<span>&euro; '.number_format($amoundSaved*31 ,2).'</span>
					</div>
					<div class="usageSaving">
						Totale besparing op jaarbasis &sup1;<br/>
						<span>&euro; '.number_format($amoundSaved*365, 2).'</span>
					</div>
				</li>
			</ul>
		</div>
	';
}

?>