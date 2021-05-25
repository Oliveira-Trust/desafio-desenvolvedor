/*
Name: 			Band
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version:	8.3.0
*/

(function( $ ) {

	'use strict';

    /*
    * Add "active" class to animate Custom Porto SVG Logo
    */
    $(window).on('load', function(){
        setTimeout(function(){
            $('.custom-porto-svg-logo').addClass('active');
        }, 1000);
    });

}).apply( this, [ jQuery ]);