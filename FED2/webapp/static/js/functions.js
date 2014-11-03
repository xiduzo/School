(function(){

	// create my listners
	var navButton 	= document.getElementById('navHandleBar');
	var nav 		= document.getElementById('mainNavigation');
	var header 		= document.getElementById('mainHeader');

	// create a simple instance
	// by default, it only adds horizontal recognizers
	var navigation 	= new Hammer(navButton);
	// swipe event to the right
	navigation.on("panright", function() {
		showNav();
	});

	// swipe event to the left
	navigation.on("panleft", function() {
		hideNav();
	});

	// for the tap / press gesture on a link
	navigation.on("tap press", function(ev) {
		nav.classList.contains('inActiveNav') ? showNav() : hideNav();
	});

	/*
	 * This function will show the navigation and moves the header
	 */
	function showNav() {
		nav.classList.remove('inActiveNav');
		header.classList.remove('inActiveNav');
		nav.classList.add('activeNav');
		header.classList.add('activeNav');
	}

	/*
	 * This function will hide the navigation and moves the header back
	 */
	function hideNav() {
		nav.classList.remove('activeNav');
		header.classList.remove('activeNav');
		nav.classList.add('inActiveNav');
		header.classList.add('inActiveNav');
	}

})();