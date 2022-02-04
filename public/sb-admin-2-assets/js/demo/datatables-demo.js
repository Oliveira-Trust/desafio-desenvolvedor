// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#data-table-produtos').DataTable({
      "info": false,
      "searching": false,
      "lengthChange": false,
      "bPaginate": false,
  }); 
});
