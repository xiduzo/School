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
					<a href="/school/project/index.php">
						<i class="fa fa-indent"></i>
						Mijn verbruik
					</a>
				</li>
				<li class="'. (($activePage == "community") ? $active : $inActive ) .'">
					<a href="/school/project/community.php">
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
					<a href="/school/project/meterstand.php">
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


function detailDisplay($what, $icon, $use, $maxUse, $measure, $cost, $date, $percentage, $moreOrLess) {
	$iconUse = $moreOrLess == 'onder' ? 'down' : 'up';
	echo '
		<div class="circleDetail" id="circel'.$what.'"><i class="fa fa-'.$icon.'"></i></div>
		<div class="usage">
			<div class="realUse">
				<em id="real'.$what.'">'.$use.'</em>/'.$maxUse.' <br/>
				<span>totaal verbruik ('.$measure.')</span>
			</div>
			<div class="toEuros">
				&euro; '.number_format($cost, 2).' <br/>
				<span>Kosten per '.$date.'</span>
			</div>
			<div class="percentage">U verbruikt '.$percentage.'% '.$moreOrLess.' het gemiddelde <i class="fa fa-arrow-circle-o-'.$iconUse.'"></i></div>
		</div>
	';
}

function detailDisplayInfo($what, $icon, $use, $measure, $percentage, $moreOrLess, $amoundSaved) {
	echo '
		<div id="detailDisplayInfo">
			<ul>
				<li>
					<div class="circleDetail" id="circel'.$what.'"><i class="fa fa-'.$icon.'"></i></div>
					<div id="usage">
						Verbruikt <br/>
						<span>'.$use.' '.$measure.'</span>
					</div>
				</li>
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