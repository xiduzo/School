(function(){

	app.debug = {
		init: function() {
			app.controller.debugMessage("debuggin'......");
		},

		geoErrorHandler: function(code, message){
			app.controller.debugMessage('geo.js error '+code+': '+message)
		},

		debugMessage: function(message){
			(customDebugging && debugId)?document.getElementById(debugId).innerHTML:app.controller.debugMessage(message);
		},

		setCustomDebugging: function(debugId){
			debugId = this.debugId;
    		customDebugging = true;
		}
	}

})();