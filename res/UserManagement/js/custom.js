/* Add here all your JS customizations */


$(document).ready(function() {
  
    $('#tags-input').tagsinput({
        maxTags: 8                                                                
    });




    $("#valorServico").inputmask( 'currency',{"autoUnmask": false,
    radixPoint:",",
    groupSeparator: ".",
    allowMinus: false,
    prefix: 'R$ ',            
    digits: 2,
    digitsOptional: false,
    rightAlign: true,
    unmaskAsNumber: true
    });

    $('#valorServico').keyup(function () {
         
        if($('#valorServico').inputmask('unmaskedvalue') > 5000){
            $('#valorServico').val(1);   
            $("#TaxaServico").val(0.1);
        }
     
    });


    
   
});

function UpdateValue(){
    
    $value = $('#valorServico').inputmask('unmaskedvalue');
  
    var valorTaxado =  (10 / 100 * $value).toFixed(2) ;

    $("#TaxaServico").val('R$ '+valorTaxado);

    $FinalValue = ($value - valorTaxado).toFixed(2);

    $("#FinalValue").html('VALOR A RECEBER <a style="color: rgb(25, 255, 36);"> R$  ' + $FinalValue + '</a>');

}
  

