(function(){

	app.tour = {
		init: function(){
			app.controller.debugMessage("tour is gestart");
		},

		updatePositie: function(){
			var newPos = new google.maps.LatLng(currentPosition.coords.latitude, currentPosition.coords.longitude);
		    map.setCenter(newPos);
		    currentPositionMarker.setPosition(newPos);
		}
	}

})();