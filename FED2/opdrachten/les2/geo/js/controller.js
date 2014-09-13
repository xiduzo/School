(function(){

	app.controller = {
		init: function() {
			app.controller.debugMessage("controller is gestart...");
			app.gps.init();
		},

		isNumber: function(n){
			return !isNaN(parseFloat(n)) && isFinite(n);
		},

		debugMessage: function(message){
			console.log(message);
		}
	}
	
	app.controller.init();

})();