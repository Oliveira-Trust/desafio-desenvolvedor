/*
Name: 			Layouts / Header Menu - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	3.1.0
*/

(function($) {

	'use strict';

	// Toggle Mega Sub Menu Expand Button
	var megaSubMenuToggleButton = function() {

		var $button = $('.mega-sub-nav-toggle');

		$button.on('click', function(){
			$(this).toggleClass('toggled');
		});

	};

	$(function() {
		megaSubMenuToggleButton();
	});

}).apply(this, [jQuery]);