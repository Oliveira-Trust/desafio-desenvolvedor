(function($){
    
    $("#enviarEmail").on("click", function(){
        var email = $("#email").val();
        var resultDestino = $("#resultDestino").text();
        var resultValor = $("#resultValor").text();
        var resultPg = $("#resultPg").text();
        var resultTaxaPg = $("#resultTaxaPg").text();
        var resultTaxaCv = $("#resultTaxaCv").text();
        var resultDescontos = $("#resultDescontos").text();
        var resultValorDestino = $("#resultValorDestino").text();
        var resultValorFinal = $("#resultValorFinal").text();

        if(email == ''){
            return alert('Por favor, informe seu e-mail.');
        }

        $.ajax({
            url: 'email',
            method: 'POST',
            data:{
                resultDestino : resultDestino,
                resultValor : resultValor,
                resultPg : resultPg,
                resultTaxaPg : resultTaxaPg,
                resultTaxaCv : resultTaxaCv,
                resultDescontos : resultDescontos,
                resultValorDestino : resultValorDestino,
                resultValorFinal : resultValorFinal,
                email : email
            },
            beforeSend: function() {
                $("#enviarEmail").hide();
                $('.loading-sm').html('<div class="lds-dual-ring-sm"></div>');
            },
            success: function (response) {
                
                if(response.success){
                    $("#enviarEmail").show();
                    $('.loading-sm').html('');
                    alert(`Cotação enviada para ${email}.`);
                }
            }
        });
    });
    
 })(jQuery)