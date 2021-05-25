/*
Name: 			Finance
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version:	8.3.0
*/
// Demo Config
(function($) {

	'use strict';

	/*
	Dialog with CSS animation
	*/
	$('.popup-with-zoom-anim').magnificPopup({
		type: 'inline',

		fixedContentPos: false,
		fixedBgPos: true,

		overflowY: 'auto',

		closeBtnInside: true,
		preloader: false,

		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-zoom-in'
	});

}).apply(this, [jQuery]);