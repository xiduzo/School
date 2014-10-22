// Make a namespace -so that multiple .js files can communicate with eachother
var app = app || {};

// Global variables

// Start the app
(function(){
	function startRouter() {
		routie({
		    'about': function() {
		    	debugMessageToConsole("> about");
		    	renderContent("about");
		    },
		    'movies': function() {
		    	debugMessageToConsole("> movies");
		    	renderContent("movies");
		    },
		    'movies/gerne/:genre': function(genre) {
		    	debugMessageToConsole(">> " + genre);
		    	renderContent("movies", genre);
		    },
		    'movies/:id': function(id) {
		    	debugMessageToConsole(">> " + id);
		    	renderContent("movies", id);
		    }
		});
	}

	function renderContent(content, filter) {
		if (content = "movies") {
			switchContent("movies", "about");
		} else {
			switchContent("about", "movies");
		}
		Transparency.render(document.getElementById(content), getContent(content, filter), getDirectives());
	}

	function getContent(content, filter) {
		var template = "";
		switch(content) {
			case "about":
				template = {
					header: "Over deze app",
					description: "Deze app laat je switchen tussen de \'about\' en \'movies\' door middel van javascript met routie en transparency. -isn\'t that awesome!-"
				}
			break;
			case "movies":
				template = getJson(filter);
			break;
		}
		return template;
	}

	function getJson(filter) {
		var jsonData = "";
		if(localStorage.getItem("movieData")) {
			jsonData = JSON.parse(localStorage.getItem("movieData"));
			debugMessageToConsole(jsonData);
			debugMessageToConsole("[rendered data from >local storage<]");
		} else {
			getJsonData("GET", "http://dennistel.nl/movies", function(response) {
				jsonData = JSON.parse(response);
				localStorage.setItem("movieData", response);
				debugMessageToConsole("[rendered data from >get request<]");
			});
		}
		
		jsonData = _.map(jsonData, function(movie) {
			movie.reviews = _.reduce(movie.reviews, function(totalScore, review) {
				return totalScore + review.score;
			}, 0) / _.size(movie.reviews);
		});

		if(filter) {
			jsonData = _.filter(jsonData, function(movie) {
				return _.contains(movie.genres, filter); 
			});
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

	function getDirectives() {
		var directives = {
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
					if (isNumber(this.reviews)){
						return this.reviews;
					} else {
						return "Geen review score beschikbaar";
					}
				}
			}
		};

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