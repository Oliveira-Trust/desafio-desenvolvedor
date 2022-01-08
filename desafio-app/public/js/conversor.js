(function($){
    // Tratamento dos dados ao clicar em converter.
    $("#converter").on("click", function(){
        var moedaDestino = $("#moedaDestino").val();
        var valor = $("#valor").val();
        valor = valor.replace(/\./g,"");
        valor = valor.replace(",",".")
        valor = Number(valor).toFixed(2);
        var pagamento = $("input[name=pagamento]:checked").val();

        if(moedaDestino == 0){
            alert('Por favor, selecione uma moeda de destino.');
        }else if(isNaN(valor) || valor == '0,00'){
            alert('Por favor, informe um valor para conversão.');
        }else if(valor < 1000.00 || valor > 100000.00){
            alert('Por favor, informe um valor entre R$ 1.000,00 e R$ 100.000,00.');
        }else{
            converter(moedaDestino, valor, pagamento);
        }
        
    });

    // Método para buscar os dados na API e retornar os dados tratados para exibição.
    function converter(moeda, valor, pagamento){
        $.ajax({
            url: `converter/${moeda}/${valor}/${pagamento}`,
            beforeSend: function() {
                $(".imagem").hide();
                $(".result").hide();
                $('#loading').show().html('<div class="lds-dual-ring"></div>');
            },
            success: function (response) {
                $('#loading').hide().html('');
                $(".result").show();
                $(".email").show();              
                var formaPg = response.formaPg;
                var moedaDestino = response.moedaDestino;
                var taxaConversao = response.taxaConversao.toFixed(2);
                var taxaPg = response.taxaPg.toFixed(2);
                var valorConvertido = response.valorConvertido.toFixed(2);
                var valorComDesconto = response.valorComDesconto.toFixed(2);
                var valorMoeda = response.valorMoeda.toFixed(2);
                var valorParaConversao = response.valorParaConversao.toFixed(2);

                $("#resultDestino").text(moedaDestino);
                $("#resultValor").text(Number(valorParaConversao).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
                $("#resultPg").text(formaPg);
                $("#resultTaxaPg").text(Number(taxaPg).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
                $("#resultTaxaCv").text(Number(taxaConversao).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
                $("#resultDescontos").text(Number(valorComDesconto).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
                $("#resultValorDestino").text(Number(valorMoeda).toLocaleString("pt-BR", { style: "currency" , currency:moedaDestino}));
                $("#resultValorFinal").text(Number(valorConvertido).toLocaleString("pt-BR", { style: "currency" , currency:moedaDestino}));

            }
        });
    }
 })(jQuery)