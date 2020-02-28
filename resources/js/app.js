require('./bootstrap');
import $ from 'jquery';
import dt from 'datatables.net-bs4';
global.$.DataTable = dt;

$(document).ready( function () {
    $('.table').DataTable();
} );