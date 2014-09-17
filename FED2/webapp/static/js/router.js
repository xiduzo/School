(function(){

	app.router = {
		init: function() {
			app.debug.debugMessageToConsole("router is gestart...");

			routie({
			    'about': function() {
			    	app.debug.debugMessageToConsole('about is aangeklikt');
			    	app.router.render('about');
			    },
			    'movies': function() {
			    	app.debug.debugMessageToConsole('movies is aangeklikt');
			    	//app.router.render('movies')
			    }
			});
		},
		render: function(template) {
			switch(template) {
				case 'about':
					var about = {
						title: 'About this app',
						description: 'beschrijving'
					}
					
					break;
				case 'movies':
					var movies = {
						title: 'Favorite movies'

					}
					break;
				default:
					break;
			}

			// hulp code
			// if(template == "users"){
			// 	var hello = {
			// 	  greeting: 'Hello',
			// 	  name:     'world!'
			// 	};
			// 	var usersTemplate = document.getElementById('users');
			// 	usersTemplate.render(hello);
			//}
		}
	}

})();