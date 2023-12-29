$(document).ready(function(){

    //masks
    $('#InputCoinValue').maskMoney({prefix:'BRL ', allowNegative: false, thousands:'.', decimal:',', affixesStay: true});
    $('#InputCoinValueBoleto').maskMoney({prefix:'BRL ', allowNegative: false, thousands:'.', decimal:',', affixesStay: true});
    $('#InputCoinValueCt').maskMoney({prefix:'BRL ', allowNegative: false, thousands:'.', decimal:',', affixesStay: true});
    $('#InputCoinValueFinalChoice').maskMoney({prefix:'BRL ', allowNegative: false, thousands:'.', decimal:',', affixesStay: true});

    $('#selectCoin').on( "change", function() {

        let prefix = $("#selectCoin option:selected").attr('prefix');
        let labelValue = $("#selectCoin option:selected").text();
        let valorMoeda = parseFloat($("#selectCoin option:selected").val());
        let valorReal  = $('#InputCoinValue').maskMoney('unmasked')[0];
        let valorConvert = 0;
        $('#btn-submit').prop('disabled', false);

        $('#selectedCurrency').val(prefix);
        $('#InputCoinValueConvert').maskMoney({prefix: prefix + " ", allowNegative: false, thousands:'.', decimal:',', affixesStay: true});
        $('#fieldValorMoeda').maskMoney({prefix: prefix + " ", allowNegative: false, thousands:'.', decimal:',', affixesStay: true});

        //verifica se o valor digitado é maior que 1000 ou menor que 100.000
        if (valorReal < 1000) {
            alert('Valor digitado deve ser maior que 1000');
            return false;
        }

        if (valorReal > 100000) {
            alert('Valor digitado não pode ser maior que 100000');
            return false;
        }

        valorConvert = parseFloat(valorReal) / parseFloat(valorMoeda).toFixed(2);
        let twoDecimals = parseFloat(valorConvert.toFixed(2));
        let valorMoedaTwoDecimals = parseFloat(valorMoeda.toFixed(2));

        //log dos valores
        console.log("valor moeda: ", valorMoedaTwoDecimals)
        console.log("valor real: ", valorReal)
        console.log("resultado: ", twoDecimals);
        console.log("prefixo: ", prefix);

        $('#valorMoeda').text(labelValue);
        $('#fieldValorMoeda').maskMoney('mask', valorMoedaTwoDecimals)
        $('#InputCoinValueConvert').maskMoney('mask', twoDecimals);

        //boleto taxa de 1.45%
        let valor = valorReal;
        let percentual = 1.45;
        let taxa = (valor * percentual) / 100;
        let billetValue = valor + taxa;
        $('#InputCoinValueBoleto').maskMoney('mask', taxa);
        console.log("valor boleto: ", billetValue);
        console.log("taxa boleto: ", taxa);

        //cartao taxa de 7.63%
        let valorCt = valorReal;
        let percentualCt = 7.63;
        let taxaCt = (valorCt * percentualCt) / 100;
        let ctValue = valor + taxa;
        $('#InputCoinValueCt').maskMoney('mask', taxaCt);
        console.log("valor boleto: ", billetValue);
        console.log("taxa boleto: ", taxa);
    } );

    $('#selectPayment').on( "change", function() {
        let labelValue = $("#selectPayment option:selected").val();
        let valorReal  = $('#InputCoinValue').maskMoney('unmasked')[0];
        let taxBillet = $('#InputCoinValueBoleto').maskMoney('unmasked')[0];
        let taxCard = $('#InputCoinValueCt').maskMoney('unmasked')[0];
        let taxa = 0;
        let taxPayment = 0;
        let valorTotal = 0;

        if (labelValue=='boleto') {
            taxPayment = taxBillet;
        }
        if (labelValue=='cartao') {
            taxPayment = taxCard;
        }

        //Valores abaixo de 3000 aplica 2% em cima do valor e 1% acima de 3000
        if(valorReal <=3000) {
            taxa = (valorReal * 2) / 100;
            valorTotal = parseFloat(taxa + (taxPayment + valorReal));
        } else {
            taxa = (valorReal * 1) / 100;
            valorTotal = parseFloat(taxa + (taxPayment + valorReal));
        }
        $('#InputCoinValueFinalChoice').maskMoney('mask', valorTotal);

        //Valor total
        console.log("type: ", labelValue);
        console.log("taxa do valor: ", taxa);
        console.log("Valor Final : ", valorTotal);

    });



});


