/*
Name: 			Pages / Calendar - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	3.1.0
*/

(function($) {

	'use strict';

	var initCalendarDragNDrop = function() {
		var Draggable = FullCalendar.Draggable;

		$('#external-events div.external-event').each(function() {
			new Draggable($(this)[0], {
		      	itemSelector: '.external-event',
		      	eventData: function(eventEl) {
		      		var eventObj = $( eventEl ).data('event');
		        	return eventObj;
		      	}
		    });
		});
	};

	var initCalendar = function() {
		var $calendar = $('#calendar');
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		var $calendarInstace = new FullCalendar.Calendar( $calendar[0], {
			themeSystem: 'bootstrap',
			eventDisplay: 'block',
			headerToolbar: {
				start: 'title',
				center: '',
				end: 'prev,today,next,dayGridDay,dayGridWeek,dayGridMonth'
			},
			bootstrapFontAwesome: {
				close: 'fa-times',
				prev: 'fa-caret-left',
				next: 'fa-caret-right',
				prevYear: 'fa-angle-double-left',
				nextYear: 'fa-angle-double-right'
			},
			editable: true,
			droppable: true, // this allows things to be dropped onto the calendar !!!
			drop: function(eventDropInfo) { // this function is called when something is dropped
				
				// is the "remove after drop" checkbox checked?
		        if ($('#RemoveAfterDrop').is(':checked')) {
		          // if so, remove the element from the "Draggable Events" list
		          eventDropInfo.draggedEl.parentNode.removeChild(eventDropInfo.draggedEl);
		        }

			},
			events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1)
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2)
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false,
					className: 'fc-event-danger'
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false
				},
				{
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'http://google.com/'
				}
			]
		});

		$calendarInstace.render();

		// FIX INPUTS TO BOOTSTRAP VERSIONS
		var $calendarButtons = $calendar.find('.fc-header-right > span');
		$calendarButtons
			.filter('.fc-button-prev, .fc-button-today, .fc-button-next')
				.wrapAll('<div class="btn-group mt-sm mr-md mb-sm ml-sm"></div>')
				.parent()
				.after('<br class="hidden"/>');

		$calendarButtons
			.not('.fc-button-prev, .fc-button-today, .fc-button-next')
				.wrapAll('<div class="btn-group mb-sm mt-sm"></div>');

		$calendarButtons
			.attr({ 'class': 'btn btn-sm btn-default' });
	};

	$(function() {
		initCalendar();
		initCalendarDragNDrop();
	});

}).apply(this, [jQuery]);