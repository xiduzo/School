// By Xiduzo

(function(){

	// create my listners
	var navButton 	= document.getElementById('navButton');
	var content		= document.getElementById('mainContent');
	var header		= document.getElementById('mainHeader');

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
		content.classList.contains('activeNav') ? hideNav() : showNav();
	});

	/*
	 * This function will show the navigation 
	 */
	function showNav() {
		content.classList.remove('inActiveNav');
		content.classList.add('activeNav');
		header.classList.remove('inActiveNav');
		header.classList.add('activeNav');
	}

	/*
	 * This function will hide the navigation
	 */
	function hideNav() {
		content.classList.remove('activeNav');
		content.classList.add('inActiveNav');
		header.classList.remove('activeNav');
		header.classList.add('inActiveNav');
	}

})();