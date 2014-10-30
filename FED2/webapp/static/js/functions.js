(function(){

	// create my listners
	var navButton 	= document.getElementById('navHandleBar');
	var nav 		= document.getElementById('mainNavigation');
	var header 		= document.getElementById('mainHeader');

	// create a simple instance
	// by default, it only adds horizontal recognizers
	var navigation 	= new Hammer(navButton);
	// swipe event to the right
	navigation.on("panright left", function() {
		nav.classList.contains('activeNav') ? nav.classList.remove('inActiveNav') : nav.classList.add('activeNav');
	    header.classList.contains('activeNav') ? header.classList.remove('inActiveNav') : header.classList.add('activeNav');
	});

	// swipe event to the left
	navigation.on("panleft", function() {
	    nav.classList.contains('activeNav') ? nav.classList.add('inActiveNav') : nav.classList.remove('activeNav');
	    header.classList.contains('activeNav') ? header.classList.add('inActiveNav') : header.classList.remove('activeNav');
	});

	// for the tap / press gesture on a link
	navigation.on("tap press", function(ev) {
	    nav.classList.toggle('activeNav');
	    nav.classList.toggle('inActiveNav');
	    header.classList.toggle('activeNav');
	    header.classList.toggle('inActiveNav');
	});

})();