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
			    },

			    'movies/gerne/:gerne': function(gerne) {
			    	app.debug.debugMessageToConsole('gerne: '+gerne);
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
					// //check if there is a local storage of the movie data					
					// if(localStorage.getItem('movieData')) {
					// 	// log to console that you got the info from local storage
					// 	app.debug.debugMessageToConsole('rendered data from local storage');
					// 	// Show the items with local storage (parsed json data)
					// 	Transparency.render(document.getElementById('movies'), JSON.parse(localStorage.getItem('movieData')), directives);
					// } else {
						// get the (json) data from the server
						app.jsonHandling.getJson('GET', 'http://dennistel.nl/movies', function(response) {
							// show the (parsed) json data
							Transparency.render(document.getElementById('movies'), JSON.parse(response), directives);
							// write in localstorage
							localStorage.setItem('movieData', response);
						});
					//}
					
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

						reviewScore: {
							text: function(){
								var totalReviewScore = this.reviews.reduce(function(memo, reviews){
									return memo + reviews.score;
								}, 0);
								
								return totalReviewScore / this.reviews.length;
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