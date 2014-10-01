(function(){

	app.router = {
		init: function() {
			// Make a new routie
			routie({
				// Listens to #about
			    'about': function() {
			    	// Test so that you can see if it respond to #about in your url
			    	app.debug.debugMessageToConsole('about is aangeklikt');
			    	// Render de content
			    	app.router.render('about');
			    },
			    // Listens to #movies
			    'movies': function() {
			    	app.debug.debugMessageToConsole('movies is aangeklikt');
			    	app.router.render('movies');
			    }
			});
		},

		/*
		 * This function will render your data object to the DOM via transparency
		 * @param template String
		 */
		render: function(template) {
			// Make a switch between different templates you want show
			switch(template) {
				case 'about':
					// Make a data object
					var aboutTemplate = {
						header: 'Over deze app',
						description: 'Deze app laat je switchen tussen de \'about\' en \'movies\' door middel van javascript met routie en transparency. -isn\'t that awesome!-'
					}
					// Render the data to the DOM using Transparency
					Transparency.render(document.getElementById('about'), aboutTemplate);
					// Switch between the two sections
					app.router.switchContent('about', 'movies');
				break;
				case 'movies':
					// check if there is a local storage of the movie data
					if(localStorage.getItem('movieData')) {
						// Show the items with local storage (parsed json data)
						Transparency.render(document.getElementById('movies'), JSON.parse(localStorage.getItem('movieData')), directives);
						// update the local storage (if possible)
						app.jsonHandling.getJson('GET', 'http://dennistel.nl/movies', function(respons) {
							// overwrite the local storage
							localStorage.setItem('movieData', respons);
						});
					} else {
						// get the (json) data from the server
						app.jsonHandling.getJson('GET', 'http://dennistel.nl/movies', function(respons) {
							// show the (parsed) json data
							Transparency.render(document.getElementById('movies'), JSON.parse(respons), directives);
							// write in localstorage
							localStorage.setItem('movieData', respons);
						});
					}
					
					// Make new directive for the image
					var directives = {
						// in the movies array get the cover
						cover: {
							// set the src to
							src: function(params) {
								// this.cover -> and add it to the DOM (the return of movieSrc)
								return this.cover;
							}
						},

						plot: {
							text: function(params) {
								return this.plot;
							}
						},

						release_date: {
							text: function(params) {
								return this.release_date;
							}
						},

						revieuws: {
							text: function(params) {
								return this.revieuws;
							}
						}
					};
					app.router.switchContent('movies', 'about');
				break;
			}
		},

		/*
		 * This function wil switch between the two section by adding classes
		 * @param activeSection String
		 * @param inactiveSeciotn String
		 */
		switchContent: function(activeSection, inactiveSection){
			document.getElementById(activeSection).className 	= "active";
			document.getElementById(inactiveSection).className 	= "inActive";
		}
	}

})();