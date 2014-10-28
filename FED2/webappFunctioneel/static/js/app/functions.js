(function(){
	$("#navHandleBar").click(function () {
        $('#navHandleBar').parent().toggleClass('activeNav');
    });

    $("nav ul li a").click(function () {
        $('#navHandleBar').parent().toggleClass('activeNav');
    });
})();