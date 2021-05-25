/*
Name: 			One Page Agency
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version:	8.3.0
*/

(function( $ ) {

	'use strict';

	var $window = $(window);

	/*
	* Collapse Menu Button
	*/
	$('.header-btn-collapse-nav').on('click', function(){
		 $('html, body').animate({
	        scrollTop: $(".header-btn-collapse-nav").offset().top - 18
	    }, 300);
	});
	
	/*
	* Isotope
	*/
    var $wrapper = $('#itemDetailGallery');

	if( $wrapper.get(0) ) {
		$wrapper.waitForImages(function() {
			$wrapper.isotope({
				itemSelector: '.isotope-item'
			});
		});
	}

	/*
	Load More
	*/
	var loadMore = {

		pages: 0,
		currentPage: 1,
		$wrapper: $('#loadMoreWrapper'),
		$btn: $('#loadMore'),
		$btnWrapper: $('#loadMoreBtnWrapper'),
		$loader: $('#loadMoreLoader'),

		build: function() {

			var self = this

			self.pages = self.$wrapper.data('total-pages');

			if(self.pages <= 1) {

				self.$btnWrapper.remove();
				return;

			} else {

				// init isotope
				self.$wrapper.isotope();

				self.$btn.on('click', function() {
					self.loadMore();
				});

				// Lazy Load
				if(self.$btn.hasClass('btn-lazy-load')) {
					theme.fn.intObs( '#loadMore', "$('#loadMore').trigger('click');", {
						rootMargin: '0px 0px 0px 0px'
					} );
				}

			}

		},
		loadMore: function() {

			var self = this;

			self.$btn.hide();
			self.$loader.show();

			// Ajax
			$.ajax({
				url: 'ajax/demo-one-page-agency-ajax-load-more-' + (parseInt(self.currentPage)+1) + '.html',
				complete: function(data) {

					var $items = $(data.responseText);

					setTimeout(function() {

						self.$wrapper.append($items)

						self.$wrapper.isotope('appended', $items);

						self.currentPage++;

						if(self.currentPage < self.pages) {
							self.$btn.show().blur();
						} else {
							self.$btnWrapper.remove();
						}

						// Carousel
						$(function() {
							$('[data-plugin-carousel]:not(.manual), .owl-carousel:not(.manual)').each(function() {
								var $this = $(this),
									opts;

								var pluginOptions = theme.fn.getOptions($this.data('plugin-options'));
								if (pluginOptions)
									opts = pluginOptions;

								$this.themePluginCarousel(opts);
							});
						});

						self.$loader.hide();

					}, 1000);

				}
			});

		}

	}

	$window.on('load', function() {
		if($('#loadMoreWrapper').get(0)) {
			loadMore.build();
		}
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

	/*
	* Map and Contact Position
	*/
	var customContactPos = {
		$elements: $('.custom-contact-pos'),
		build: function() {
			var self = this;

			self.init();
		},
		init: function() {
			var self = this,
				elementHeight = [];

			// Get Map and Contact Box Height
			self.$elements.each(function(){
				elementHeight.push($(this).outerHeight());
			});

			// Set Map and Contact box with same height
			self.$elements.each(function(){
				$(this).css({
					height: Math.max.apply(null, elementHeight)
				})
			});

			// Set contact-box position over google maps
			$('.custom-contact-box').css({
				'margin-top': -Math.max.apply(null, elementHeight)
			});
		}
	}

	if( $('.custom-contact-pos').get(0) ) {
		customContactPos.build();
	}

}).apply( this, [ jQuery ]);