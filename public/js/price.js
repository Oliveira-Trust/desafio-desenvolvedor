jQuery(document).ready(function($){

    //----- close model -----//
        jQuery('#btn-close').click(function () {
            jQuery('#formModal').modal('hide');
        });

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
        var ajaxurl = 'prices';
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                getAllPrices();
                var price = `
                
                Moeda de origem: ${data.currency_from} <br />
                Moeda de destino: ${data.currency_to} <br />
                Valor para conversão: ${data.total} <br />
                Forma de pagamento: ${data.payment_method} <br />
                Valor da "Moeda de destino" usado para conversão: ${data.weight_to} <br />
                Valor comprado em "Moeda de destino": ${data.buy_to_rate} (taxas aplicadas no valor de compra diminuindo no valor total de conversão) <br />
                Taxa de pagamento: ${data.payment_rate} <br />
                Taxa de conversão: ${data.conversion_rate} <br />
                Valor utilizado para conversão descontando as taxas: ${data.total_rate} <br />
                `;

                jQuery('#todo-list').html(price);
                jQuery('#formModal').modal('show')
            },
            error: function (data) {     
                var error = `Código do erro ${data.status} <br />
                            Mensagem: ${data.statusText} <br />
                            
                            Nosso time ja esta sabendo disso, tente novamente mais tarde =]`;

                jQuery('#todo-list').html(error);
                jQuery('#formModal').modal('show')
            }
        });
    });


    function getAllPrices()
    {
        var type = "GET";
        var ajaxurl = 'prices/getall';

        $.ajax({
            type: type,
            url: ajaxurl,
            dataType: 'json',
            beforeSend: function(){
                jQuery('#myPrices').html("<img src='img/loader.gif' width=30 />");
            },
            success: function (data) {

                var html = ''

                if(data.length == 0){
                    html = '<div> Nehuma cotação disponível no momento, aproveite para fazer a primeira :)'
                }

                $(data).each(function(index, element) {
                
                    html += "<div style='margin-bottom:10px'>"
                    html += `<div class='text-sm'> ${element.currency_from}-${element.currency_to} (<span class='text-green-500'>${element.total}</span>) em ${element.created_at}</div>`;
                    html += `<div class='text-xs'> TP: <span class='text-red-500'> ${element.payment_rate} </span> TC: <span class='text-red-500'> ${element.conversion_rate} </span>  VC: <span class='text-green-500'> ${element.buy_to_rate} </span> </div>`;
                    html += "</div>"
                });
            
                jQuery('#myPrices').html(html);
                jQuery('#legend').css('display', 'block');

            },
            error: function (data) {
                console.log(data);
            }
        });

    }

    getAllPrices();

});