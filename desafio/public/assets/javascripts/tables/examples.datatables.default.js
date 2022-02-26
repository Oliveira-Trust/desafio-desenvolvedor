

(function( $ ) {

	'use strict';

	var datatableInit = function() {

		$('#t-quote').dataTable();

	};

	$(function() {
		datatableInit();
	});

}).apply( this, [ jQuery ]);