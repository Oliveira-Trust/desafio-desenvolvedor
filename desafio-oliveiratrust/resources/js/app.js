import './bootstrap';


$(document).ready(function() {
    $('#theme-toggle').change(function() {
        $.ajax({
            url: '/toggle-theme',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function() {
                location.reload();
            }
        });
    });
});