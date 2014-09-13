(function(){

	app.gps = {
		init: function() {
			debug_message("Controleer of GPS beschikbaar is...");
			app.gps.startInterval();
		},

		startInterval: function(){
			debug_message("GPS is beschikbaar, vraag positie.");
			app.gps.updatePosition();
			interval = self.setInterval(
				app.gps.startInterval, 
				REFRESH_RATE
			);
			ET.addListener(
				POSITION_UPDATED, 
				app.gps.checkLocations()
			);
		},

		updatePosition: function(){
			intervalCounter++;
			geo_position_js.getCurrentPosition(
				app.gps.setPosition(),
				app.debug.geoErrorHandler(),
				{enableHighAccuracy:true}
			);
		},

		setPosition: function(position){
			currentPosition = position;
			ET.fire(POSITION_UPDATED);
			debug_message(intervalCounter+" positie lat:"+position.coords.latitude+" long:"+position.coords.longitude);
		},

		checkLocations: function(event){
			for (var i = 0; i < locaties.length; i++) {
		        var locatie = {coords:{latitude: locaties[i][3],longitude: locaties[i][4]}};

		        if(app.gps.calculateDistance(locatie, currentPosition)<locaties[i][2]){

		            // Controle of we NU op die locatie zijn, zo niet gaan we naar de betreffende page
		            if(window.location!=locaties[i][1] && localStorage[locaties[i][0]]=="false"){
		                // Probeer local storage, als die bestaat incrementeer de locatie
		                try {
		                    (localStorage[locaties[i][0]]=="false")?localStorage[locaties[i][0]]=1:localStorage[locaties[i][0]]++;
		                } catch(error) {
		                    debug_message("Localstorage kan niet aangesproken worden: "+error);
		                }

		// TODO: Animeer de betreffende marker

		                window.location = locaties[i][1];
		                debug_message("Speler is binnen een straal van "+ locaties[i][2] +" meter van "+locaties[i][0]);
		            }
		        }
		    }
		},

		calculateDistance: function(p1, p2){
			var pos1 = new google.maps.LatLng(p1.coords.latitude, p1.coords.longitude);
		    var pos2 = new google.maps.LatLng(p2.coords.latitude, p2.coords.longitude);
		    return Math.round(google.maps.geometry.spherical.computeDistanceBetween(pos1, pos2), 0);
		}
	} // end pf app.gps
})();