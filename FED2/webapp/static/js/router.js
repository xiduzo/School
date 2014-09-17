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
		 * This function will render your dataobject to the DOM via transparency
		 * @param template string
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
					break;
				case 'movies':
					var moviesTemplate = {
						titleMovies: 'Favorite movies',
						movies: 	[ {
							title: 'Shawshank Redemption',
							releaseDate: '14 October 1994',
							description: 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
							cover: 'static/images/shawshank-redemption.jpg'
						}, {
							title: 'The Godfather',
							releaseDate: '24 March 1972',
							description: 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.',
							cover: 'static/images/the-godfather.jpg'
						}, {
							title: 'Pulp Fiction',
							releaseDate: '14 October 1994',
							description: 'The lives of two mob hit men, a boxer, a gangster\'s wife, and a pair of diner bandits intertwine in four tales of violence and redemption.',
							cover: 'static/images/pulp-fiction.jpg'
						}, {
							title: 'The Dark Knight',
							releaseDate: '18 July 2008',
							description: 'When Batman, Gordon and Harvey Dent launch an assault on the mob, they let the clown out of the box, the Joker, bent on turning Gotham on itself and bringing any heroes down to his level.',
							cover: 'static/images/the-dark-knight.jpg'
						}
						]	
					}
					Transparency.render(document.getElementById('movies'), moviesTemplate);
					break;
			}

			// simple help code
			// if(template == "testTemplate"){
			// 	var foo = {
			// 	  greeting: 'bar'
			// 	};
			// 	Transparency.render(document.getElementById('getID'), foo);
			//}
		}
	}

})();