Number.prototype.formatNumber = function(decimals, sepDecimals, sepThousand){
    if(decimals==null)decimals=2;
    if(sepDecimals==null)sepDecimals=",";
    if(sepThousand==null)sepThousand=".";

    var n = new String(this.toFixed(decimals)).replace(".","").split("");
    n.reverse();
    var fn = new Array();
    var cont = decimals+1;
    for(this.i=0;this.i<n.length;this.i++){
        if(this.i==decimals-1 && n.length>decimals-1){
            fn.unshift(sepDecimals+n[this.i]);
        }else{
            if(cont--==0 && this.i != n.length-1){
                fn.unshift(sepThousand+n[this.i]);
                cont = 2;
            } else fn.unshift(n[this.i]);
        }
    }
    return fn.join("");
}


function FormataDecimal(obj) {
    obj = obj.replace(".","").replace(",",".");
    return obj;
}

$(document).ready(function(){

    $('body').on('keydown', '.Money', function() {
        $(".Money").mask("000.000.000.000.000,00", {reverse: true});
    });

    $('.FormDisable :input').prop('disabled', true);

    $('body').on('change', '.LessValue', function() {
        var Value       = $(this).val();
        if(Value) { 
            Value       = parseFloat(FormataDecimal(Value));
            BiggerValue =  Value + 0.01;

            $('.BiggerValue').val(BiggerValue.formatNumber(2,",","."));
        }        


    });

    $('body').on('change', '.BiggerValue', function() {
        var Value       = $(this).val();
        if(Value) { 
            Value       = parseFloat(FormataDecimal(Value));
            BiggerValue =  Value - 0.01;

            $('.LessValue').val(BiggerValue.formatNumber(2,",","."));
        }        

    });

});