(function(){

	// create my listners
	var navButton 	= document.getElementById('navHandleBar');
	var nav 		= document.getElementById('mainNavigation');
	var header 		= document.getElementById('mainHeader');

	// create a simple instance
	// by default, it only adds horizontal recognizers
	var navigation 	= new Hammer(navButton);
	// swipe event to the right
	navigation.on("panright", function(ev) {
	    nav.classList.add('activeNav');
	    //navButton.childNodes[0].classList.remove('icon-reorder');
	    //navButton.childNodes[0].classList.add('icon-remove');
	    header.classList.add('activeNav');
	});

	// swipe event to the left
	navigation.on("panleft", function(ev) {
	    nav.classList.remove('activeNav');
	    //navButton.childNodes[0].classList.add('icon-reorder');
	    //navButton.childNodes[0].classList.remove('icon-remove');
	    header.classList.remove('activeNav');
	});

	// for the tap / press gesture on a link
	navigation.on("tap press", function(ev) {
	    nav.classList.toggle('activeNav');
	    //navButton.childNodes[0].classList.toggle('icon-reorder');
	    //navButton.childNodes[0].classList.toggle('icon-remove');
	    header.classList.toggle('activeNav');
	});

})();