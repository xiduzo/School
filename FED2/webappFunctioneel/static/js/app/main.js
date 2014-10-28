(function(){

	function startRouter() {
		routie({
			'': function() {
				renderContent('about');
			},
		    'about': function() {
		    	renderContent("about");
		    },
		    'movies': function() {
		    	renderContent("movies");
		    },
		    'movies/gerne/:genre': function(genre) {
		    	renderContent("movies", genre);
		    },
		    'movies/:id': function(id) {
		    	renderContent("movies", id);
		    }
		});
	}

	function loader() {
		$('#loader').toggleClass('active');
		setTimeout(function () { $('#loader').toggleClass('active'); }, 2000);
	}

	function renderContent(content, filter) {
		loader();
		content == "movies" ? switchContent("movies", "about") : switchContent("about", "movies");
		Transparency.render(document.getElementById(content), getContent(content, filter), getDirectives(content));
	}

	function getContent(content, filter) {
		switch(content) {
			case "about":
				template = {
					header: "Over deze app",
					description: "Deze app laat je switchen tussen de \'about\' en \'movies\' door middel van javascript met routie en transparency. -isn\'t that awesome!-"
				}
			break;
			case "movies":
				template = getJson(filter);
				avarage(template);
			break;
		}

		return template;
	}

	function avarage(json) {
		_.map(json, function(movie) {
			movie.reviews = _.reduce(movie.reviews, function(total, review) {
				return total + review.score;
			}, 0) / _.size(movie.reviews);
		});
		return json;
	}

	function filterData(json, filter) {
		jsonData = _.filter(json, function(movie) {
			return _.contains(movie.genres, filter); 
		});

		return json;
	}

	function getJson(filter) {
		try {
			jsonData = JSON.parse(localStorage.getItem("movieData"));
			throw _.isEmpty(jsonData) ? "Geen {local storage} beschikbaar" : "Items worden opgehaald uit de {local storage}";
		} catch(err) {
			debugMessageToConsole(err);
		} finally {
			getJsonData("GET", "http://dennistel.nl/movies", function(response) {
				localStorage.setItem("movieData", response);
			});
		}
		
		if(filter) {
			filterData(jsonData, filter);
		}

		return jsonData;
	}

	function getJsonData(type, url, success, data) {
		var req = new XMLHttpRequest;
		req.open(type, url, true);
		req.setRequestHeader("Content-type","application/json");

		type === "POST" ? req.send(data) : req.send(null);

		req.onreadystatechange = function() {
			if (req.readyState === 4) {
				if (req.status === 200 || req.status === 201) {
					success(req.responseText);
				}
			}
		}
	}

	function getDirectives(directives) {
		switch(directives) {
			case "movies":
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
							return isNumber(this.reviews) ? this.reviews : "Geen review score beschikbaar";
						}
					}
				};
			break;
		}

		return directives;
	}

	function debugMessageToConsole(m) {
		console.log(m);
	}

	function isNumber(n) {
		return !isNaN(parseFloat(n)) && isFinite(n);
	}

	function switchContent(activeSection, inactiveSection) {
		document.getElementById(activeSection).className 	= "active";
		document.getElementById(inactiveSection).className 	= "inActive";
	}

	startRouter();
})();