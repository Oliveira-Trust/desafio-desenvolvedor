
$('.money').mask("#.##0,00", {reverse: true});
$('.date').mask('00/00/0000');
$('.date-month-year').mask('00/0000');
$('.cpf').mask('000.000.000-00', {reverse: true});
$('.cei').mask('0000000000/00', {reverse: true});
$('.cnpj').mask('00.000.000/0000-00', {reverse: false});
$('.cep').mask('00000-000');
$('.numeric').mask('#');
$('.time').mask('00:00');


/*$(document).on("ajaxComplete", function(e){
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: false});
    $('.cei').mask('0000000000/00', {reverse: true});
    $('.numeric').mask('#');
});*/

$('.float').mask('000000000000000,0', {reverse: true});
$('.percent').mask('##0,0', {reverse: true});

$(function () {
    const SPMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };

    $('.sp_celphones').mask(SPMaskBehavior, spOptions);
});


$(function () {
    const SPMaskBehavior2 = function (val) {
        const length = val.replace(/\D/g, '').length;

            return (length === 3 || length === 4) ? '00:009' : '000:00';
        },
        spOptions2 = {
            onKeyPress: function(val, e, field, options) {
                field.mask(SPMaskBehavior2.apply({}, arguments), options);
            }
        };

    $('.time_extra').mask(SPMaskBehavior2, spOptions2);
});

