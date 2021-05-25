/*
Name: 			Gym
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version:	8.3.0
*/

(function( $ ) {

	'use strict';
	
	// Slider Options
	var sliderOptions = {
		sliderType: 'standard',
		sliderLayout: 'fullscreen',
		responsiveLevels: [4096,1200,992,420],
		gridwidth:[1170,970,750],
		delay: 5000,
		disableProgressBar: 'on',
		lazyType: "none",
		shadow: 0,
		spinner: "off",
		shuffle: "off",
		autoHeight: "off",
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
			keyboardNavigation: "on",
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
			},
			bullets: {
				style:"custom-tp-bullets",
		        enable: true,
		        container:"slider",
		        rtl: false,
		        hide_onmobile: false,
		        hide_onleave: true,
		        hide_delay: 200,
		        hide_delay_mobile: 1200,
		        hide_under: 0,
		        hide_over: 9999,
		        direction:"horizontal",
		        space: 20,       
		        h_align: "center",
		        v_align: "bottom",
		        h_offset: 0,
		        v_offset: 50
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

	// Instagram Feed
    $(window).on('load', function(){

        if( $( '.custom-instagram-feed-carousel' ).get(0) ) {
        
            var $this = $( '.custom-instagram-feed-carousel' ),
                username = 'oklerportogym',
                $wrapper = $this,
                html = $wrapper.html();

            // Instagram Feed Basic
            $this.instagramFeed({
                'username': username,
                'get_data': true,
                'callback': function(data, $this){
                    var $wrapper = $( $this ),
                        html     = $wrapper.html(),
                        images   = data.edge_owner_to_timeline_media.edges,
                        output   = '',
                        image_url = '',
                        caption = '',
                        link = '',
                        items_number = ( $wrapper.data('items-number') ) ? $wrapper.data('items-number') : 6;

                    // Limit items number
                    if( items_number > 12 ) {
                        items_number = 12;
                    }

                    // Set a minimum for items number
                    if( items_number < 1 ) {
                        items_number = 1;
                    }

                    // Loop trough each instagram image result
                    for( var i=0; i < items_number; i++ ) {
                        
                        if( typeof images[i] == 'undefined' ) {
                            break;
                        }

                        // Image URL
                        if( typeof images[i].node.display_url != 'undefined' ) {
                            image_url = images[i].node.display_url;
                        }

                        // Image Caption
                        if( typeof images[i].node.edge_media_to_caption.edges[0] != 'undefined' ) {
                            caption = images[i].node.edge_media_to_caption.edges[0].node.text;
                        }

                        // Post Link
                        if( typeof images[i].node.shortcode != 'undefined' ) {
                            link = images[i].node.shortcode;
                        }

                        output += '<div style="background: url('+ image_url +'); background-size: cover;">';
                        	output += '<a target="_blank" href="https://www.instagram.com/p/'+ link +'/"></a>';
                        output += '</div>';
                    }

                    // Build Html
                    $wrapper.append(output);

                    $wrapper.addClass('owl-carousel').owlCarousel({
                        items: 2,
						nav: false,
						dots: false,
						loop: true,
						navText: [],
						autoplay: true,
						autoplayTimeout: 6000,
						rtl: ( $('html').attr('dir') == 'rtl' ) ? true : false
                    });
                }
            });

        }

    });

    // Custom Menu Style
    if($('.custom-header-style-1').get(0)) {
    	$('.header-nav-main nav > ul > li > a').each(function(){
	    	var parent = $(this).parent(),
	    		clone  = $(this).clone(),
	    		clone2 = $(this).clone(),
	    		wrapper = $('<span class="wrapper-items-cloned"></span>');

	    	// Config Classes
	    	$(this).addClass('item-original');
	    	clone2.addClass('item-two');

	    	// Insert on DOM
	    	parent.prepend(wrapper);
	    	wrapper.append(clone).append(clone2);
	    });
    }

    // Isotope
    var $wrapper = $('#itemDetailGallery');

	if( $wrapper.get(0) ) {
		$wrapper.waitForImages(function() {
			$wrapper.isotope({
				itemSelector: '.isotope-item'
			});
		});
	}
    
}).apply( this, [ jQuery ]);