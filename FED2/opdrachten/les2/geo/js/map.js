(function(){

	app.map = {
		init: function() {
			app.map.generateMap();
		},

		generateMap: function(myOptions, canvasId){
			app.controller.debugMessage("Genereer een Google Maps kaart en toon deze in #"+canvasId);

			map = new google.maps.Map(document.getElementById(canvasId), myOptions);

			var routeList = [];

			app.controller.debugMessage("Locaties intekenen, tourtype is: "+tourType);

		    for (var i = 0; i < locaties.length; i++) {

		        // Met kudos aan Tomas Harkema, probeer local storage, als het bestaat, voeg de locaties toe
		        try {
		            (localStorage.visited==undefined||app.controller.isNumber(localStorage.visited))?localStorage[locaties[i][0]]=false:null;
		        } catch (error) {
		            debug_message("Localstorage kan niet aangesproken worden: "+error);
		        }

		        var markerLatLng = new google.maps.LatLng(locaties[i][3], locaties[i][4]);
		        routeList.push(markerLatLng);

		        markerRij[i] = {};
		        for (var attr in locatieMarker) {
		            markerRij[i][attr] = locatieMarker[attr];
		        }
		        markerRij[i].scale = locaties[i][2]/3;

		        var marker = new google.maps.Marker({
		            position: markerLatLng,
		            map: map,
		            icon: markerRij[i],
		            title: locaties[i][0]
		        });
		    }
		// TODO: Kleur aanpassen op het huidige punt van de tour
		    if(tourType == LINEAIR){
		        // Trek lijnen tussen de punten
		        debug_message("Route intekenen");
		        var route = new google.maps.Polyline({
		            clickable: false,
		            map: map,
		            path: routeList,
		            strokeColor: 'Black',
		            strokeOpacity: .6,
		            strokeWeight: 3
		        });

		    }

		    // Voeg de locatie van de persoon door
		    currentPositionMarker = new google.maps.Marker({
		        position: kaartOpties.center,
		        map: map,
		        icon: positieMarker,
		        title: 'U bevindt zich hier'
		    });

		    // Zorg dat de kaart geupdated wordt als het POSITION_UPDATED event afgevuurd wordt
		    ET.addListener(POSITION_UPDATED, app.map.updatePositie());
		},

		updatePositie: function(){
			var newPos = new google.maps.LatLng(currentPosition.coords.latitude, currentPosition.coords.longitude);
		    map.setCenter(newPos);
		    currentPositionMarker.setPosition(newPos);
		}
	}

})();