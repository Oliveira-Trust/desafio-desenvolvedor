jQuery(document).ready(function($){
    
    // CREATE
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            currency_from: jQuery('#currency_from').val(),
            currency_to: jQuery('#currency_to').val(),
            total: jQuery('#total').val(),
            payment_method: jQuery('#payment_method').val(),
        };
        var state = jQuery('#btn-save').val();
        var type = "POST";
        var ajaxurl = 'price';
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                // var todo = '<tr id="todo' + data.id + '"><td>' + data.id + '</td><td>' + data.title + '</td><td>' + data.description + '</td>';
                // if (state == "add") {
                //     jQuery('#todo-list').append(todo);
                // } else {
                //     jQuery("#todo" + todo_id).replaceWith(todo);
                // }
                // jQuery('#myForm').trigger("reset");
                // jQuery('#formModal').modal('hide')
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});