$("#valor").mask('000.000.000.000.000,00', {reverse: true});

$("#valor").on("change", () => {
    let valor = $("#valor").val();

    valor = valor.replace('.', '').replace(',', '.');

    $("#valor").val(valor);
});

$("#origem").on("change", () => {
    $("#block").show();

    let origem = $("#origem").val();

    $.ajax({
        dataType: "json",
        url: `${baseUrl}/api/moedas-without-origem/${origem}`
    })
    .done((data) => {
        let options = `<option value="" selected>Selecione...</option>`;

        $.each(data, (key, val)=>{
            let option = `<option value="${val.id}" data-sigla="${val.sigla}">${val.descricao}</option>`;
            options += option;
        });

        $('#destino').find('option').remove().end().append(options);

        $("#block").hide();
    });
});

$("#destino").on("change", () => {    
    $("#block").show();

    let siglaOrigem = $("#origem option:selected").data("sigla");
    
    let siglaDestino = $("#destino option:selected").data("sigla");

    let codConversao = `${siglaDestino}-${siglaOrigem}`;

    var bid = 0;

    $.ajax({
        dataType: "json",
        url: `https://economia.awesomeapi.com.br/json/last/${codConversao}`
    })
    .done((data) => {
        let cod = `${siglaDestino}${siglaOrigem}`;
        
        $("#valor-moeda-destino").val(data[cod].bid);
    });

    $("#block").hide();
});