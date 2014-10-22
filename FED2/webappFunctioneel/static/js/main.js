// Make a namespace -so that multiple .js files can communicate with eachother
var app = app || {};

(function(){
	startRouter();
})();

function startRouter() {
	routie({
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

function renderContent(content, filter) {
	debugMessageToConsole('je hebt gekozen voor:' +content+ ' met de filter ' + filter);
	Transparency.render(document.getElementById(content), getContent(content, filter), getDirectives(content));
	if (content === "movies") {
		switchContent("movies", "about");
	} else {
		switchContent("about", "movies");
	}
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
		break;
	}
	return template;
}

function getJson(filter) {
	try {
		jsonData = JSON.parse(localStorage.getItem("movieData"));
		if (_.isEmpty(jsonData)) throw "Geen local storage beschikbaar";
	} catch(err) {
		debugMessageToConsole(err);
	} finally {
		XHR("GET", "http://dennistel.nl/movies", function(response) {
			localStorage.setItem("movieData", response);
		});
	}
	
	_.map(jsonData, function(movie) {
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

function XHR(type, url, success, data) {
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