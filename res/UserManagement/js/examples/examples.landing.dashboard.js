/*
Name: 			Landing Dashboard - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	3.1.0
*/

/*
* Isotope
*/
var $wrapperSampleList = $('.sample-item-list'),
	$window  = $(window);

$window.on('load', function() {
	$wrapperSampleList.isotope({
		itemSelector: ".isotope-item",
		layoutMode: 'fitRows'
	});
});

// Recalculate Isotope items size on Sidebar left Toggle
$window.on('sidebar-left-toggle', function(){
	$wrapperSampleList.isotope('layout');
});