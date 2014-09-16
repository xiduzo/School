(function(){

	app.controller = {
		init: function() {
			app.controller.debugMessage("controller is gestart...");
			if (app.controller.isNumber(1)){
				app.controller.debugMessage("nummer controller werkt [is nummer]");
			} else {
				app.controller.debugMessage("nummer controller werkt [is geen nummer]");
			}
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