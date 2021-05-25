/*
Name: 			eCommerce / eCommerce Sidebar Overlay - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	3.1.0
*/

(function($) {

	'use strict';

	var $sidebarOverlay    	   = $('.ecommerce-form-sidebar-overlay-wrapper'),
		$sidebarOverlayBody    = $sidebarOverlay.find('.ecommerce-form-sidebar-overlay-body'),
		$sidebarOverlayContent = $sidebarOverlay.find('.ecommerce-form-sidebar-overlay-content');

	/*
	 * Open Sidebar Overlay
	 *
	 */
	$(document).on('click', '.ecommerce-sidebar-link', function(e){
		e.preventDefault();

		var $this = $(this);

		$sidebarOverlay.addClass('show');

		// Show Loading Overlay Dots
		$sidebarOverlay
			.find('.loading-overlay')
			.parent()
			.addClass('loading-overlay-showing');

		$.ajax({
			url: $this.data('ajax-url'),
		}).always(function(data, textStatus, jqXHR) {
			
			// Remove Loading Overlay Showing Class
			$sidebarOverlay
				.find('.loading-overlay')
				.parent()
				.removeClass('loading-overlay-showing');

			// Render ajax response
			$sidebarOverlayContent.html( data );

			// Initialize Select2 fields
			if ( $.isFunction($.fn[ 'select2' ]) ) {
				$(function() {
					$('[data-plugin-selectTwo]').each(function() {
						var $this = $( this ),
							opts = {};

						var pluginOptions = $this.data('plugin-options');
						if (pluginOptions)
							opts = pluginOptions;

						$this.themePluginSelect2(opts);
					});
				});
			}

			$(window).trigger('resize');
			$(window).trigger('ecommerce.sidebar.overlay.show');
		});
			
	});

	/*
	 * Close Sidebar Overlay
	 *
	 */
	$(document).on('click', '.ecommerce-form-sidebar-overlay-wrapper', function(e){
		var $this = $(this);

		if( $(e.target).hasClass('ecommerce-form-sidebar-overlay-wrapper') ) {
			$this.removeClass('show');
		}
	});

	$(document).on('click', '.ecommerce-form-sidebar-overlay-close, .cancel-button', function(e){
		e.preventDefault();

		$sidebarOverlay.removeClass('show');
	});

}(jQuery));