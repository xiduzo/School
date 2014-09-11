(function(){

	app.controller = {
		init: function() {
			console.log("controller is gestart [1]");
			app.gps.init();
		},

		isNumber: function(){

		}
	}
	
	app.controller.init();

})();