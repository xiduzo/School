var app = app || {};

(function(){

	app.controller = {
		init: function() {
			console.log("controller is gestart [1]");
			app.gps.init();
		},

		isNumber: function(){

		}
	}

	app.gps = {
		init: function() {
			console.log("gps is gestart [2]");
			app.map.init();
		},

		startInterval: function(){
		},

		updatePosition: function(){

		},

		setPosition: function(){

		},

		checkLocations: function(){

		},

		calculateDistacne: function(){

		}
	}

	app.map = {
		init: function() {
			console.log("map is gestart [3]");
			app.tour.init();
		},

		generateMap: function(){

		}
	}

	app.tour = {
		init: function(){
			console.log("tour is gestart [4]");
			app.debug.init();
		},

		updatePosition: function(){
			
		}
	}

	app.debug = {
		init: function() {
			console.log("debug is gestart [5]");
		},

		geoErrorHandler: function(){

		},

		debugMessage: function(){

		},

		setCustomDebugging: function(){

		}
	}
	
	app.controller.init();
	
})();