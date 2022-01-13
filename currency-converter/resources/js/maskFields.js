$(function(){
    $(".money").maskMoney({symbol: "R$", decimal: ",", thousands: "."});
    $('.percent').mask('##0.00', {reverse: true});
});
