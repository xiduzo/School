(function(){
	debugger;

	app.router = {
		init: function() {
			// Make a new routie
			routie({
				// Listens to #about
			    'about': function() {
			    	// Test so that you can see if it respond to #about in your url
			    	app.debug.debugMessageToConsole('> about');
			    	// Render de content
			    	app.router.render('about');
			    },
			    // Listens to #movies
			    'movies': function() {
			    	app.debug.debugMessageToConsole('> movies');
			    	app.router.render('movies');
			    },

			    'movies/gerne/:genre': function(genre) {
			    	app.debug.debugMessageToConsole('>> ' + genre);
			    	app.router.render('movies', genre);
			    },

			    'movies/:id': function(id) {
			    	app.debug.debugMessageToConsole('>> ' + id);
			    	app.router.render('movies', id);
			    }
			});
		},

		/*
		 * This function will render your data object to the DOM via transparency
		 * @param template String
		 */
		render: function(template, filter) {
			// Make new directives
			var directives = {

				// in the movies array get the cover
				cover: {
					// set the src to
					src: function() {
						// this.cover -> and add it to the DOM src of the image
						return this.cover;
					}
				},

				// make the movei title clickable, routie can listen to this new hashes
				movieUrl: {
					// Set the link
					href: function() {
						return '#movies/'+this.id;
					},
					// set the title of the link
					text: function() {
						return this.title;
					}
				},

				release_date: {
					text: function() {
						return this.release_date;
					}
				},

				simple_plot: {
					text: function() {
						return this.simple_plot;
					}
				},

				// Get the average score of a movie based on its' reviews
				reviewScore: {
					text: function(){						
						// Check if the score value is a number
						if (app.controller.isNumber(this.reviews)){
							// if so returns this number
							return this.reviews;
						} else {
							// else returns this string
							return 'Geen review score beschikbaar';
						}
					}
				}
			};

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
					//check if there is a local storage of the movie data					
					if(localStorage.getItem('movieData')) {
						var jsonData = JSON.parse(localStorage.getItem('movieData'));

						// Reduce the review scores to one average score
						_.map(jsonData, function(movie) {
							// Get all the scores
							movie.reviews = _.reduce(movie.reviews, function(totalScore, review) { 
								// Sum them into one number
								return totalScore + review.score; 
								// Set the base to 0 and devide the totalScore with the amount of reviews
							}, 0) / _.size(movie.reviews);
						});

						// Check if you got a (not empty) parameter
						if(filter) {
							// If this is a number (movie ID)
							if(app.controller.isNumber(filter)) {
								jsonData = _.filter(jsonData, function(movie) {
									return _.where(movie, {id: filter});
								});
							// If this is a string (type of movie)
							} else {
								// Filter the jsonData
								jsonData = _.filter(jsonData, function(movie) {
									// returns every movie which got the gerne of the filter parameter. 
									return _.contains(movie.genres, filter); 
								});
							}
						}

						// log the data oject you're working with
						app.debug.debugMessageToConsole(jsonData);
						// log to console that you got the info from local storage
						app.debug.debugMessageToConsole('[rendered data from >local storage<]');
						// Show the items with local storage (parsed json data)
						Transparency.render(document.getElementById('movies'), jsonData, directives);
					} else {
						// get the (json) data from the server
						app.jsonHandling.getJson('GET', 'http://dennistel.nl/movies', function(response) {
							var jsonData = JSON.parse(response);
							// log to console that you got the info from local storage
							app.debug.debugMessageToConsole('[rendered data from >get request<]')
							// Render the data to the DOM
							Transparency.render(document.getElementById('movies'), jsonData, directives);
							// write in localstorage
							localStorage.setItem('movieData', response);
						});
					}
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