jQuery(document).ready(function($){

    // CREATE OR UPDATE
    $("#btn-save-setting").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            currency_from: jQuery('#currency_from').val(),
            ticket: jQuery('#ticket').val(),
            card: jQuery('#card').val(),
        };
        var type = "POST";
        var ajaxurl = 'settings';
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
               console.log(data)
            },
            error: function (data) {     
                console.log(data)
            }
        });
    });

    function getAllSettings()
    {
        var type = "GET";
        var ajaxurl = 'settings/getall';

        $.ajax({
            type: type,
            url: ajaxurl,
            dataType: 'json',
            success: function (data) {
                $(data).each(function(index, element) {
                    jQuery(`#${element.key}`).val(`${element.value}`)

                    if(element.key == "currency_from"){
                        $(`#currency_from option[value=${element.value}]`).attr('selected', true);
                    }
                });
            },
            error: function (data) {
                console.log(data);
            }
        });

    }

    getAllSettings();

});