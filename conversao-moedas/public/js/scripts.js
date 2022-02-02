$("#converter").click(function() {
   $.ajax({
         url  : '/conversao-moeda',
         type : "POST",
         dataType : "json",
         data : {
            _token : $("input[name='_token']").val(),
            moedaDestino : $("#moeda-destino").val(),
            valorConversao : $("input[name='valor-conversao']").val(),
            formaPagamento : $("#forma-pagamento").val(),
         },
         success:function(data) {
           console.log('data', data);
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





