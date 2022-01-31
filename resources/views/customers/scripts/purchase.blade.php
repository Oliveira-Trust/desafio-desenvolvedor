<script>

    // executa o cáuculo
    const calculate = async () => {
        const url = '{{ route('customer.exchanges.calculate-purchase') }}';
        const data = await getDataForm('#exchange_puchase')
        const minValue = {{$purchaseInterval->min ?? '1001'}}  ;
        const maxValue = {{$purchaseInterval->max ?? '100001'}} ;
        const isValidAmount = (data['calc[purchase_value]'] > minValue && data['calc[purchase_value]'] < maxValue);

        if (isValidAmount) {
            var jqxhr = $.ajax(
                {
                    method: "post",
                    url: url,
                    data: data
                })
                .done(function (response) {
                    console.log(response)
                    updateDataScreen(response.data);
                    $('#info-exchange').show();
                })
                .fail(function () {
                    alert("Falha na consulta!");
                })
                .always(function () {
                    // alert("complete");
                });
        } else {
            alert('O valor deve ser superior à R$ ' + minValue + ' e inferior à R$ ' + maxValue + '!')
        }
    }
    // pega o dados do formulário
    const getDataForm = async function (ID = null) {
        ID = ID ? ID : id;
        var inputs = $(ID + ' :input');
        var values = {};
        await inputs.each(function () {
            if (this.name)
                if ($(this).prop('type') === 'checkbox') {
                    if ($(this).prop('checked')) {
                        values[this.name] = true;
                    } else {
                        values[this.name] = false;
                    }
                } else {
                    values[this.name] = $(this).val();
                }
        });
        searchData = await values;
        return values;
    }
    const updateDataScreen = async (data) => {
        await $('#purchaseValue span').text(data.amount);
        await $('#currencyFrom span').text(data.from);
        await $('#currencyTo span').text(data.to);
        await $('#currencyToValue span').text(data.to_value);
        await $('#creditCardTax span').text(data.creditCard.tax);
        await $('#creditCardTaxValue span').text(data.creditCard.amount);
        await $('#creditCardPurchaseValue span').text(data.creditCard.puchase_amount_to);
        await $('#creditCardPurchaseValue b').text(data.to);
        await $('#ticketTax span').text(data.ticket.tax);
        await $('#ticketTaxValue span').text(data.ticket.amount);
        await $('#tiketPurchaseValue span').text(data.ticket.puchase_amount_to);
        await $('#tiketPurchaseValue b').text(data.to);
    }
    const cleanSearch = async (data) => {
        await $('#purchaseValue span').text('');
        await $('#currencyFrom span').text('');
        await $('#currencyTo span').text('');
        await $('#currencyToValue span').text('');
        await $('#creditCardTax span').text('');
        await $('#creditCardTaxValue span').text('');
        await $('#creditCardPurchaseValue span').text('');
        await $('#ticketTax span').text('');
        await $('#ticketTaxValue span').text('');
        await $('#tiketPurchaseValue span').text('')
        await $('#purchase').val(0.00);
    }
</script>
