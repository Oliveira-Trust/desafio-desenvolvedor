/*
Name: 			View - Home
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version:	8.3.0
*/

(function($) {

	'use strict';

	/*
	Circle Slider
	*/
	if ($.isFunction($.fn.flipshow)) {
		var circleContainer = $('.fc-slideshow');
	
		$.each( circleContainer, function() {
				
			var $container = $(this);
				
			$container.flipshow();

			setTimeout(function circleFlip() {
				$container.data().flipshow._navigate($container.find('div.fc-right span:first'), 'right');
				setTimeout(circleFlip, 3000);
			}, 3000);
			
		});
	}

	/*
	Move Cloud
	*/
	if ($('.cloud').get(0)) {
		var moveCloud = function() {
			$('.cloud').animate({
				'top': '+=20px'
			}, 3000, 'linear', function() {
				$('.cloud').animate({
					'top': '-=20px'
				}, 3000, 'linear', function() {
					moveCloud();
				});
			});
		};

		moveCloud();
	}

}).apply(this, [jQuery]);