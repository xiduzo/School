// By Xiduzo

(function(){

	// create my listners
		// Navigation
		var navButton 	= document.getElementById('navButton');
		var content		= document.getElementById('mainContent');
		var header		= document.getElementById('mainHeader');

		// add new hammers
		var navigation 		= new Hammer(navButton);
		var contentPress 	= new Hammer(content);
		
		// menu 
			// swipte menu to the right
			navigation.on("panright", function() {
				showNav();
			});

			// swipe menu back to the left
			navigation.on("panleft", function() {
				hideNav();
			});

			// toggle menu
			navigation.on("tap press", function() {
				content.classList.contains('activeNav') ? hideNav() : showNav();
			});

			// swipe "content" back to the left
			contentPress.on("panleft", function() {
				if(content.classList.contains('activeNav')) {
					hideNav();
				}
			});

			// menu options
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