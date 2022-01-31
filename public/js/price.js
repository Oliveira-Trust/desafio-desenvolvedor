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

        var type = "POST";
        var ajaxurl = 'prices';
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                getAllPrices();

                var price = '';

                $(data).each(function(index, element) {

                    price += `<h2> ID: ${element.id} ${element.currency_from}/${element.currency_to}</h2>`
                
                    price += `
                        Moeda de origem: ${element.currency_from} <br />
                        Moeda de destino: ${element.currency_to} <br />
                        Valor para conversão: ${element.total} <br />
                        Forma de pagamento: ${element.payment_method} <br />
                        Valor da "Moeda de destino" usado para conversão: ${element.weight_to} <br />
                        Valor comprado em "Moeda de destino": ${element.buy_to_rate} (taxas aplicadas no valor de compra diminuindo no valor total de conversão) <br />
                        Taxa de pagamento: ${element.payment_rate} <br />
                        Taxa de conversão: ${element.conversion_rate} <br />
                        Valor utilizado para conversão descontando as taxas: ${element.total_rate} <br />
                    `;
                });

                if(price.length ==0 ){
                    price += "<h2> Critério de aceitação </h2>";
                    price += "Deve ser possível escolher uma moeda estrangeira entre pelo menos 2 opções sendo o seu valor de compra maior que R$ 1.000 e menor que R$ 100.000,00 e sua forma de pagamento em boleto ou cartão de crédito tendo como resultado o valor que será adquirido na moeda de destino e as taxas aplicadas";
                }

                jQuery('#todo-list').html(price);
                jQuery('#formModal').modal('show')
            },
            error: function (data) {     
                var error = `Código do erro ${data.status} <br />
                            Mensagem: ${data.statusText} <br />`;

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

                var html = '';

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