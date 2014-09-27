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
						description: 'Deze app laat je switchen tussen de \'about\' en \'movies\' door middel van javascript met routie en transparency'
					}
					// Render the data to the DOM using Transparency
					Transparency.render(document.getElementById('about'), aboutTemplate);
					// Switch between the two sections
					app.router.switchContent('about', 'movies');
				break;
				case 'movies':
					var moviesTemplate = {
						titleMovies: 'Favorite movies',
						// Make an array of movies (next step to get them with an API?)
						movies: 	[ {
							title: 'Shawshank Redemption',
							releaseDate: '14 October 1994',
							descriptionMovie: 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
							coverDirective: 'static/images/shawshank-redemption.jpg'
						}, {
							title: 'The Godfather',
							releaseDate: '24 March 1972',
							descriptionMovie: 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.',
							coverDirective: 'static/images/the-godfather.jpg'
						}, {
							title: 'Pulp Fiction',
							releaseDate: '14 October 1994',
							descriptionMovie: 'The lives of two mob hit men, a boxer, a gangster\'s wife, and a pair of diner bandits intertwine in four tales of violence and redemption.',
							coverDirective: 'static/images/pulp-fiction.jpg'
						}, {
							title: 'The Dark Knight',
							releaseDate: '18 July 2008',
							descriptionMovie: 'When Batman, Gordon and Harvey Dent launch an assault on the mob, they let the clown out of the box, the Joker, bent on turning Gotham on itself and bringing any heroes down to his level.',
							coverDirective: 'static/images/the-dark-knight.jpg'
						}
						]	
					};

					// Make a new decorator object
					movieSrc = function() {
						// return the HTML code
						return "<img src='" + this.coverDirective + "' />";
					};

					// Make new directive for the image
					var directives = {
						// in the movies array
						movies: {
							// take the cover directive
							coverDirective: {
								// and add it to the DOM (the return of movieSrc)
								html: movieSrc 
							}
						}
					};

					Transparency.render(document.getElementById('movies'), moviesTemplate, directives);
					app.router.switchContent('movies', 'about');
				break;
			}

			// simple help code
			// if(template == "testTemplate"){
			// 	var foo = {
			// 	  greeting: 'bar'
			// 	};
			// 	Transparency.render(document.getElementById('getID'), foo);
			//}
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