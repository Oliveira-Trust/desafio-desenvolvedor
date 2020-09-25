$.fn.datepicker.dates['pt-BR'] = {
    days: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],
    daysShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
    daysMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
    months: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
    monthsShort: ['Jan','Fev','Mar','Abr','Mai','Jun', 'Jul','Ago','Set','Out','Nov','Dez'],
    today: "Hoje",
    clear: "Limpar",
    format: "dd/mm/yyyy",
    titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
    weekStart: 0
};

$('.datepickerbr').datepicker({
    language: 'pt-BR'
});

$(".mask_cpf").mask("999.999.999-99");
$('.money').maskMoney({allowNegative: false, thousands:'.', decimal:',', affixesStay: false});