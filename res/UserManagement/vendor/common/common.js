// Tooltip and Popover
(function($) {
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover();
})(jQuery);

// Tabs
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	$(this).parents('.nav-tabs').find('.active').removeClass('active');
	$(this).parents('.nav-pills').find('.active').removeClass('active');
	$(this).addClass('active').parent().addClass('active');
});

// Bootstrap Datepicker
if (typeof($.fn.datepicker) != 'undefined') {
	$.fn.bootstrapDP = $.fn.datepicker.noConflict();
}

// Simple Sticky Header
if( $('html.simple-sticky-header-enabled').get(0) ) {
	var $window = $(window),
		distance = ( typeof $('html').data('sticky-header-distance') != 'undefined' ? $('html').data('sticky-header-distance') : 100 );

	$window.on('scroll', function(){
		if( $window.scrollTop() > distance ) {
			$('html').addClass('simple-sticky-header-active');
		} else {
			$('html').removeClass('simple-sticky-header-active');
		}
	});
}