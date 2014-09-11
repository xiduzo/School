var app = app || {};

(function(){

	app.controller = {
		init: function() {
			console.log("controller is gestart [1]");
			app.gps.init();
		}
	}

	app.gps = {
		init: function() {
			console.log("gps is gestart [2]");
			app.map.init();
		}
	}

	app.map = {
		init: function() {
			console.log("map is gestart [3]");
			app.tour.init();
		}
	}

	app.tour = {
		init: function(){
			console.log("tour is gestart [4]");
			app.debug.init();
		}
	}

	app.debug = {
		init: function() {
			console.log("debug is gestart [5]");
		}
	}
	
	app.controller.init();
	
})();