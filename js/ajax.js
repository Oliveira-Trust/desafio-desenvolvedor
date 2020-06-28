var jsonDados = '';

function carregarDados(acao,tipo,dado){


    $.ajax({
        url :  acao,
        type : tipo,
        data : dado,
        async: false,

    })
        .done(function(json){
            jsonDados = JSON.parse(json);
        })
        .fail(function(jqXHR, textStatus, msg){
            alert(msg);
        });

}