import './bootstrap';
import '../sass/app.scss'
import * as bootstrap from 'bootstrap'
import "/node_modules/select2/dist/css/select2.css";


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

