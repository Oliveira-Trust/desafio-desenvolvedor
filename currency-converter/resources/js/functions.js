$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.active-popover').popover()
});

var CalculatorController = (function(){
    var form = $('#formCalculator');
    var formData = {
        coin_to: "",
        money: "",
        type_of_payment: ""
    };
    
    let validityFormData = function(){
        var money   = form.find('#money').val();
        money       = money.replace('.', '').replace(',', '.');
        money       = parseFloat(money);

        formData = {
            coin_to: form.find('#coin_to').val(),
            money: money,
            type_of_payment: form.find('input[name="type_of_payment"]:checked').val()
        };
        
        if(!formData.money || formData.money < form.find('#money').data('min') || formData.money > form.find('#money').data('max')){
            form.find('#money').addClass('border-red');
            form.find('#money').focus();

            return false;
        }

        return true;
    };

    let convertMoney = function(){
        let button = $(this);
        button.attr('disabled', 'disabled');
        
        $('.list-of-result').hide();

        if( validityFormData() ){
            $.post('/convertMoney', formData).done(function(data){
                if(data.status == "ok"){
                    $('.apply-coin-to').html(data.coin_to);
                    $('.apply-money').html(data.money);
                    $('.apply-type-payment').html(data.type_payment);
                    $('.apply-price-money').html(data.price_money);
                    $('.apply-converted-money').html(data.converted_money);
                    $('.apply-payment-rate').html(data.payment_rate);
                    $('.apply-cost-conversion').html(data.cost_conversion);
                    $('.apply-money-to-convert').html(data.money_convert);
                    $('.list-of-result').show();
                }
            });
        }

        setTimeout(function(){
            button.removeAttr('disabled');
        }, 2000);
    };

    let startEvents = function(){
        form.find('#convertMoney').on('click', convertMoney);
        form.find('#money').on('click', function(){
            $(this).removeClass('border-red');
        });

    };

    let init = function(){
        startEvents();
    };

    return {
        init: init
    }
}());

if($('.start-controller-calc').length){
    CalculatorController.init();
}