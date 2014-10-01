$(document).ready(function(){

	$("nav").swipe( {
        //Generic swipe handler for all directions
        swipeLeft:function(event, direction, distance, duration, fingerCount) {
          $('nav').slideToggle(450);

        },
        //Default is 75px, set to 0 for demo so any distance triggers swipe
        threshold:0
    });

     $('.swipe').swipe({
        swipeRight:function(event, direction, distance, duration, fingerCount) {
            $('.swipe').addClass('groot');
            $('.swipe').removeClass('klein');
        },
        //Default is 75px, set to 0 for demo so any distance triggers swipe
        threshold:0
    });

     $('.swipe').swipe({
        swipeLeft:function(event, direction, distance, duration, fingerCount) {
            $('.swipe').addClass( 'klein');
            $('.swipe').removeClass( 'groot');
        },
        //Default is 75px, set to 0 for demo so any distance triggers swipe
        threshold:0
    });

});

