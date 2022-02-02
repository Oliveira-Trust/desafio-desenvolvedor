$("#converter").click(function(){
   console.log('cliquei');
   $.ajax({
        url : '/conversao-moeda',
        type : "POST",
        dataType : "json",
        data: {
            _token : $("input[name='_token']").val(),
            moedaDestino : $("#moeda-destino").val(),
            valorConversao : $("input[name='valor-conversao']").val(),
            formaPagamento : $("#forma-pagamento").val(),
        },
        success:function(data) {
           console.log('data', data);

            // let mensagens = '';

            // if(data.message && typeof data.message === 'object') {
            //     $.each(data.message, function(key,value){
            //         mensagens += value + "\n";
            //     });
            //     alert('Aviso \n ' + mensagens);
            // }
            // else {
            //     alert(data.message);
            // }
        }
    });
});

$(document).ready(function(){
   $('#valor-conversao').mask('000.000.000.000.000,00', {reverse: true});
});





