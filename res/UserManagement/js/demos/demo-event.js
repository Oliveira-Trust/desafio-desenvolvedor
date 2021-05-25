/*
Name:           Event
Written by:     Okler Themes - (http://www.okler.net)
Theme Version:  8.3.0
*/

(function( $ ) {
	
	'use strict';

	/*
	* Rev Slider
	*/
	var sliderOptions = {
		sliderType: 'standard',
		sliderLayout: 'auto',
		stopLoop: "on",
		stopAfterLoops: 0,
		stopAtSlide: 1,
		autoPlay: false,
		disableProgressBar: 'on',
		responsiveLevels: [1920, 1200, 992, 500],
		gridwidth: [1170, 970, 750],
		gridheight: 700,
		lazyType: "none",
		shadow: 0,
		spinner: "off",
		shuffle: "off",
		autoHeight: "on",
		fullScreenAlignForce: "off",
		fullScreenOffset: "",
		hideThumbsOnMobile: "off",
		hideSliderAtLimit: 0,
		hideCaptionAtLimit: 0,
		hideAllCaptionAtLilmit: 0,
		debugMode: false,
		fallbacks: {
			simplifyAll: "off",
			nextSlideOnWindowFocus: "off",
			disableFocusListener: false,
		},
		navigation: {
			keyboardNavigation: "off",
			keyboard_direction: "horizontal",
			mouseScrollNavigation: "off",
			onHoverStop: "off",
			touch: {
				touchenabled: "on",
				swipe_threshold: 75,
				swipe_min_touches: 1,
				swipe_direction: "horizontal",
				drag_block_vertical: false
			},
			arrows: {
				enable: false,
				style: "custom-arrows-style-1",
				left : {
					container:"slider",
					h_align:"left",
					v_align:"center",
					h_offset:0,
					v_offset:0,
				},
				right : {
					container:"slider",
					v_align:"center",
					h_align:"right",
					h_offset:0,
					v_offset:0
				}
			}
		},
		parallax:{
			type:"on",
			levels:[20,40,60,80,100],
			origo:"enterpoint",
			speed:400,
			bgparallax:"on",
			disable_onmobile:"off"
		}
	}
		
	// Slider Init
	$('#revolutionSlider').revolution(sliderOptions);

	// To Next Slider On Click
	$('.custom-rev-next').on('click', function(e) {
		e.preventDefault();
		$('#revolutionSlider').revnext();
	});

	/*
	Popup with video or map
	*/
	$('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,

		fixedContentPos: false
	});

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

	// IE Adjust Carousel Height
	if( $('html.ie, html.ie11').get(0) ) {
		var $window = $(window),
			$carousel = $('.custom-about-carousel .wrapper');

		// First load
		$carousel.height( $carousel.parent().prev().outerHeight() );

		// On Resize
		$window.on('resize', function(){
			$carousel.height( $carousel.parent().prev().outerHeight() );
		});
	}

}).apply( this, [ jQuery ]);
