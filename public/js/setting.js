jQuery(document).ready(function ($) {

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
                jQuery('#feedback').html('Configurações salvas com sucesso!');
            },
            error: function (data) {
                jQuery('#feedback').html('Houve algum erro ao salvar suas configurações!');
            }
        });
    });

    function getAllSettings() {
        var type = "GET";
        var ajaxurl = 'settings/getall';

        $.ajax({
            type: type,
            url: ajaxurl,
            dataType: 'json',
            success: function (data) {

                $(`#currency_from option[value=${data.currency_from}]`).attr('selected', true);
                jQuery("#ticket").val(`${data.ticket}`);
                jQuery("#card").val(`${data.card}`);

            },
            error: function (data) {
                console.log(data);
            }
        });

    }

    getAllSettings();

});