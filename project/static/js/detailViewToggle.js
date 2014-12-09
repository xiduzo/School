(function(){

	// create my listners
		// Navigation
		var detailButton 	= document.getElementById('showDetailButton');
		var content			= document.getElementById('detailUseSection');

		// add new hammers
		var button 		= new Hammer(detailButton);
		
		// content
			// toggle section
			button.on("tap press", function() {
				content.classList.contains('viewDetail') ? hideContent() : showContent();
			});

			// content options
				/*
				 * This function will show the detail content
				 */
				function showContent() {
					content.classList.remove('hideDetail');
					content.classList.add('viewDetail');
				}

				/*
				 * This function will hide the detail content
				 */
				function hideContent() {
					content.classList.remove('viewDetail');
					content.classList.add('hideDetail');
				}

})();