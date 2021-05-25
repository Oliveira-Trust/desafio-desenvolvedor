/*
Name: 			eCommerce / eCommerce Orders Detail - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	3.1.0
*/

(function($) {

	'use strict';

	/*
	 * Status - Select2 With Templating
	 *
	 */
	$('select[name="orderStatus"]').select2({
		minimumResultsForSearch: -1,
		templateResult: formatOrderStatus,
		templateSelection: formatOrderStatus,
		theme: 'bootstrap'
	});

	function formatOrderStatus(status) {
	  	if (!status.id) {
	    	return status.text;
	  	}

	  	var $status = $(
	    	'<span class="ecommerce-status '+ status.id +'">'+ status.text +'</span>'
	  	);

	  	return $status;
	};

}(jQuery));