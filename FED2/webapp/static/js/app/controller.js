(function(){
	// Make a controller object
	app.controller = {
		init: function() {
			// Start the router method init
			app.router.init();
		},

		// Example of a controller function
		/*
		 * This function will evaluate if the parameter is a number or not
		 * @param n 
		 * @return boolean true | false
		 */
		isNumber: function(n){
			return !isNaN(parseFloat(n)) && isFinite(n);
		}
	}
	
	// Start the controller init function
	app.controller.init();

})();