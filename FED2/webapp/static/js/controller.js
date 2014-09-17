(function(){

	app.controller = {
		init: function() {
			app.debug.debugMessageToConsole("controller is gestart...");
			app.router.init();
		},

		isNumber: function(n){
			return !isNaN(parseFloat(n)) && isFinite(n);
		}
	}
	
	app.controller.init();

})();