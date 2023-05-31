
window.onload = function () {
    var existeresultado =  document.getElementById("resultadofinal");
    if (existeresultado != null){
        document.getElementById("resultadofinal").style.display = 'none';
        while (document.scrollHeight > document.offsetHeight) {
            document.rows += 1;
        }
    }  
}

$(document).ready(function(){
    $("#valorReferencia").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
    $("#taxaMaior").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
    $("#taxaMenor").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});

    $("#taxa").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
    $("#valor").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
});

function converter() {

    var formcadastro = document.getElementById('frmconversao');
    formcadastro.addEventListener('submit', function(event){
        event.preventDefault();
    })

    var valorRecebido = $('#valor').val().toString().replace(".", "").replace(",", ".");
    var moeda = $('#moeda').val();
    var formaPag = $('#formaPag').val();
    var userId = $('#userid').val();    

    $.ajax({
        url: 'http://127.0.0.1:8000/api/conversaoMoeda',
        method: 'POST',
        data: {
            valorConversao: valorRecebido,
            moedaDestino: moeda,
            tipoFormaPagamento: formaPag,
            user_id: userId,
        },
        dataType: 'json'
    }).done(function (resposta) {
        $('#resultadofinal').val('Moeda de origem: ' + resposta.resultado['moedaOrigem'] + "\n" +
            'Moeda de destino: ' + resposta.resultado['moedaDestino'] + "\n" +
            'Valor para conversão: ' + resposta.resultado['valorConversao'] + "\n" +
            'Forma de pagamento: ' + resposta.resultado['formaPagamento'] + "\n" +
            'Valor da "Moeda de destino" usado para conversão: ' + resposta.resultado['valorMoedaDestino'] + "\n" +
            'Valor comprado em "Moeda de destino":  ' + resposta.resultado['valorCompradoMoedaDestino'] + "\n" +
            'Taxa de pagamento: ' + resposta.resultado['valorTaxaPagamento'] + "\n" +
            'Taxa de conversão: ' + resposta.resultado['valorTaxaConversao'] + "\n" +
            'Valor utilizado para conversão descontando as taxas: ' + resposta.resultado['valorConversaoDescontadoTaxa']
        );
        document.getElementById("resultadofinal").style.display = "block";

    });
}

function cadastrarUsuario() {
    var formcadastro = document.getElementById('cadastro');
    formcadastro.addEventListener('submit', function(event){
        event.preventDefault();
    })
    var nome = $('#nome').val();
    var email = $('#email').val();
    var senha = $('#senha').val();

    $.ajax({
        url: 'http://127.0.0.1:8000/api/usuario/cadastrarUsuario',
        method: 'POST',
        data: {
            nome: nome,
            email: email,
            senha: senha,
        },
        dataType: 'json'

    }).done(function (resposta) {
        if (resposta.status == 200) {
            window.location = "http://127.0.0.1:8000/conversao";
        }

    });

}


function efetuarLogin() {
    var email = $('#emaillogin').val();
    var senha = $('#senhalogin').val();

    $.ajax({
        url: 'http://127.0.0.1:8000/api/usuario/login',
        method: 'POST',
        data: {
            email: email,
            senha: senha,
        },
        dataType: 'json',

    }).done(function (resposta) {

        if (resposta.status == 200) {

            window.location = "http://127.0.0.1:8000/conversao";
        }

    });

}

function cadastrarTaxaConversao() {

    var frmtaxaconversao = document.getElementById('frmtaxaconversao');
    frmtaxaconversao.addEventListener('submit', function(event){
        event.preventDefault();
    })

    var valorReferencia = $('#valorReferencia').val().toString().replace(".", "").replace(",", ".");
    var taxaMaior = $('#taxaMaior').val().toString().replace(".", "").replace(",", ".");
    var taxaMenor = $('#taxaMenor').val().toString().replace(".", "").replace(",", ".");

    $.ajax({
        url: 'http://127.0.0.1:8000/api/taxa/cadastrarTaxaConversao',
        method: 'POST',
        data: {
            valorReferencia: valorReferencia,
            taxaMaior: taxaMaior,
            taxaMenor: taxaMenor,
        },
        dataType: 'json'

    }).done(function (resposta) {

        if (resposta.status == 200) {

            window.location = "http://127.0.0.1:8000/conversao";
        }

    });

}

function cadastrarTaxaFormaPagamento() {

    var frmtaxapagamento = document.getElementById('frmtaxapagamento');
    frmtaxapagamento.addEventListener('submit', function(event){
        event.preventDefault();
    })
    
    var tipoFormaPagamento = $('#tipoFormaPagamento').val().toString().replace(".", "").replace(",", ".");
    var taxa = $('#taxa').val().toString().replace(".", "").replace(",", ".");

    $.ajax({
        url: 'http://127.0.0.1:8000/api/taxa/cadastrarTaxaFormaPagamento',
        method: 'POST',
        data: {
            tipoFormaPagamento: tipoFormaPagamento,
            taxa: taxa,
        },
        dataType: 'json'

    }).done(function (resposta) {

        if (resposta.status == 200) {

            window.location = "http://127.0.0.1:8000/conversao";
        }

    });

}

