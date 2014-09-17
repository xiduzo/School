(function(){

	app.debug = {
		init: function() {
			app.debug.debugMessageToConsole("debug is gestart...");
		},

		debugMessageToConsole: function(message){
			console.log(message);
		}
	}

})();