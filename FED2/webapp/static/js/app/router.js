(function(){

	app.router = {
		/*
		 *	This function will be called on when the app starts.
		 *	In this init the routie lister will listen to the URL
		 */
		init: function() {
			// Make a new routie {hash listner} : function()
			routie({
				// if empty show this
			    '': function() {
			    	// Render de content
			    	app.router.render('about');
			    },
				// Listens to #about
			    'about': function() {
			    	// Render de content
			    	app.router.render('about');
			    },
			    // Listens to #movies
			    'movies': function() {
			    	app.router.render('movies');
			    },
			    // Gets the gerne from the url
			    'movies/gerne/:genre': function(genre) {
			    	app.router.render('movies', genre);
			    },
			    // Gets the id from the url
			    'movies/:id': function(id) {
			    	app.router.render('movies', id);
			    }
			});
		},

		loader: function() {
			document.getElementById('loader').classList.toggle('active');
			setTimeout(function () { document.getElementById('loader').classList.toggle('active'); }, 2000);
		},

		/*
		 *	This function will render the content into the DOM with transparency
		 *	@param {string}			content
		 *	@param {string || int} 	filter
		 */
		render: function(content, filter) {
			// Switching between the content pages
			content == "movies" ? app.router.switchContent("movies", "about") : app.router.switchContent("about", "movies");
			// Set a fake loader
			app.router.loader();
			// Render the data into the HTML DOM
			Transparency.render(document.getElementById(content), app.router.getContent(content, filter), app.router.getDirectives(content, filter));
		},

		/*
		 * This function will switch between the content needed to be displayed
		 *	@param {string}			content
		 *	@param {string || int} 	filter
		 *	@return {object}		template
		 */
		getContent: function(content, filter) {
			switch(content) {
				case "about":
					template = {
						header: "Over deze app",
						description: "Deze app laat je switchen tussen de \'about\' en \'movies\' door middel van javascript met routie en transparency. -isn\'t that awesome!-"
					}
				break;
				case "movies":
					// Get the json data
					template = app.router.getJson(filter);

					// avarage the scores of the movies
					app.router.avarage(template);
				break;
			}

			return template;
		},

		/*
		 *	This function will get you your JSON data, from local storage or from the dennistel API
		 *	@param {string || int} 	filter
		 *	@return {object}		jsonData
		 */
		getJson: function(filter) {
			// Try catch method for getting the json needed
			try {
				jsonData = JSON.parse(localStorage.getItem("movieData"));
				throw _.isEmpty(jsonData) ? "Geen {local storage} beschikbaar" : "Items worden opgehaald uit de {local storage}";
			} catch(err) {
				app.debug.debugMessageToConsole(err);
			} finally {
				app.jsonHandling.getJson("GET", "http://dennistel.nl/movies", function(response) {
					localStorage.setItem("movieData", response);
				});
			}
			
			// if there is a filter given
			if(filter) {
				app.router.filterData(jsonData, filter);
			}

			return jsonData;
		},

		/*
		 * 	This function will filter the JSON data needed to be displayed
		 *	@param {object}		json
		 *  @param {object}		filter
		 *	@return {object}	json
		 */
		filterData: function(json, filter) {
			if(app.controller.isNumber(filter)) {
				jsonData = _.find(json, function(movie){ 
					return movie.id == filter; 
				});
			} else {
				jsonData = _.filter(json, function(movie) {
					return _.contains(movie.genres, filter); 
				});
			}

			return jsonData;
		},

		/*
		 *	This function will get you the right directives to input into the HTML DOM
		 *	@param {string}		directives
		 *	@return {object}	directives
		 */
		getDirectives: function(directives, filter) {
			switch(directives) {
				case "movies":
				if(app.controller.isNumber(filter)) {
					directives = {
						cover: {
							src: function() {
								return this.cover;
							}
						},
						movieUrl: {
							text: function() {
								return this.title;
							}
						},
						releaseDate: {
							text: function() {
								return this.release_date;
							}
						},
						longPlot: {
							text: function() {
								return this.plot;
							}
						}
					};
				} else {
					directives = {
						cover: {
							src: function() {
								return this.cover;
							}
						},
						movieUrl: {
							href: function() {
								return "#movies/"+this.id;
							},
							text: function() {
								return this.title;
							}
						},
						reviewScore: {
							text: function(){	
								return app.controller.isNumber(this.reviews) ? this.reviews : "Geen review score beschikbaar";
							}
						},
						simplePlot: {
							text: function() {
								return this.simple_plot;
							}
						}
					};
				}
					
				break;
			}

			return directives;
		},

		/*
		 * This function will avarage the scores given to any movie
		 *	@param {object}		json
		 *	@return {object}	json
		 */
		avarage: function(json){
			_.map(json, function(movie) {
				movie.reviews = _.reduce(movie.reviews, function(total, review) {
					return total + review.score;
				}, 0) / _.size(movie.reviews);
			});
			return json;
		},

		/*
		 * This function wil switch between the two section by adding classes
		 * @param {string} 		activeSection
		 * @param {string} 		inactiveSeciotn
		 */
		switchContent: function(activeSection, inactiveSection){
			document.getElementById(activeSection).className 	= "active";
			document.getElementById(inactiveSection).className 	= "inActive";
		}
	}

})();