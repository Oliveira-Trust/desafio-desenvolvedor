const inputAmount = document.querySelector(".amount"),
        buyCurrency = document.querySelector('.buy-currency');

buyCurrency.addEventListener('click', function(e) {
    e.preventDefault();

    let btnContext = this;
    btnContext.classList.add('disabled')

    let errors = document.querySelector('.app-errors');
    let result = document.querySelector('.app-result');

    let amount_to_convert = document.querySelector('#amount_to_convert');
    let final_currency = document.querySelector('#final_currency');
    let payment_method = document.querySelector('#payment_method');

    amount_to_convert_fmt = (amount_to_convert.value).replaceAll('.', '').replace(',', '.')

    if (amount_to_convert.value === "" || final_currency.value === "" || payment_method.value === "") {
        alert("Todos os campos são obrigatórios!");
        return;

    }

    let payload = {
        "initial_currency": "BRL",
        "final_currency": final_currency.value,
        "amount_to_convert": parseFloat(amount_to_convert_fmt),
        "payment_method": payment_method.value
    }

    axios.post('/api/v1/conversion', payload, {
        "Accept": "application/json"
    }).then(function(response) {
        amount_to_convert.value = ""
        final_currency.value = ""
        payment_method.value = ""

        let data = `
Moeda de origem: BRL<br>
Moeda de destino: ${response.data.result.finalCurrency}<br>
Valor para conversão: ${response.data.result.amountToConvert}<br>
Forma de pagamento: ${response.data.result.paymentMethod}<br>
Valor da "Moeda de destino" usado para conversão: ${response.data.result.bidOnConversion}<br>
Valor comprado em "Moeda de destino": ${response.data.result.convertedAmount}<br>
Taxa de pagamento: ${response.data.result.paymentTax}<br>
Taxa de conversão: ${response.data.result.conversionTax}<br>
Valor utilizado para conversão descontando as taxas: ${response.data.result.amountWithTaxes}<br>`;

        if (!errors.classList.contains('d-none')) {
            errors.classList.add('d-none')
        }

        result.innerHTML = "<h2>Compra realizada com sucesso! Seguem os dados da trasação:</h2><br>" + data;
        result.classList.remove('d-none')
    }).catch(function(error) {
        let data = ""

        if (!error.response.data.errors) {
            data = error.response.data.message
        } else {
            Object.values(error.response.data.errors).forEach(function(key, index) {
                data += key + "<br>"
            })
        }

        if (!result.classList.contains('d-none')) {
            result.classList.add('d-none')
        }

        errors.innerHTML = "<h2>Ocorreu um erro na compra!:</h2><br>" + data;
        errors.classList.remove('d-none')
    }).finally(function() {
        btnContext.classList.remove('disabled')
    });
})

$(document).ready(function() {
    $('.amount').mask("#.##0,00", {reverse: true});
})
