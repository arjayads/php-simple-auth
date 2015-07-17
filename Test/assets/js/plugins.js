$(function(){

	smooth_target();

});

/*
* Add Smooth Scrolling Transition
*/

var smooth_target = function(){

	$('a[href^="#"]').click(function(event) {

		var id 		= $(this).attr("href");
		var target 	= $(id).offset().top;

		$('html, body').animate({ scrollTop:target }, 500);

		event.preventDefault();
	});

}