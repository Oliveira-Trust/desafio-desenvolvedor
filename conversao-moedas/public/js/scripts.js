$("#converter").click(function() {
   $.ajax({
         url  : '/conversao-moeda',
         type : "POST",
         dataType : "json",
         data : {
            _token : $("input[name='_token']").val(),
            moedaDestino : $("#moeda-destino").val(),
            valorConversao : formatarValorMonetarioAPI($("input[name='valor-conversao']").val()),
            formaPagamento : $("#forma-pagamento").val(),
         },
         success:function(data) {
            $("#dadosConversao").show();
            $("#moedaOrigem").html('Moeda de origem: ' + data.moedaOrigem);
            $("#moedaDestino").html('Moeda de destino:  ' + data.moedaDestino);
            $("#valorConversao").html('Valor para conversão R$:  ' + data.valorConversao);
            $("#formaPagamento").html('Forma de pagamento:  ' + data.formaPagamento);
            $("#valorMoedaDestino").html('Valor da "Moeda de destino" usado para conversão R$: ' + data.valorMoedaDestino);
            $("#valorCompradoMoedaDestino").html('Valor comprado em "Moeda de destino": ' + data.valorCompradoMoedaDestino);
            $("#taxaPagamento").html('Taxa de pagamento: R$ ' + data.taxaPagamento);
            $("#taxaConversao").html('Taxa de conversão: R$ ' + data.taxaConversao);
            $("#valorConversaoDescontos").html('Valor utilizado para conversão descontando as taxas: R$ ' + data.valorConversaoDescontos);
         },
         error: function(data) {
            let mensagens = '';
            $.each(data.responseJSON.errors, function(field,message){
               mensagens += message[0] + "\n";
            });
            alert('Aviso \n ' + mensagens);
         },
   });
});

$(document).ready(function(){
   $('#valor-conversao').mask('000.000.000.000.000,00', {reverse: true});
});

function formatarValorMonetarioAPI(val) {
   let valor     = val.replace('.', '');
   let novoValor = valor.replace(',', '.');
   return novoValor;
}