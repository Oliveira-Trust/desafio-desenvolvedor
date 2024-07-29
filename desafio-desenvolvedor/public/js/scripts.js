document.getElementById('conversion-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const destinationCurrency = document.getElementById('destination-currency').value;
    const amount = document.getElementById('amount').value;
    const paymentMethod = document.getElementById('payment-method').value;

    fetch(`/convert?currency=${destinationCurrency}&amount=${amount}&payment=${paymentMethod}`)
        .then(response => response.json())
        .then(data => {
            const resultDiv = document.getElementById('result');
            resultDiv.innerHTML = `
                <p>Moeda de origem: BRL</p>
                <p>Moeda de destino: ${data.destination_currency}</p>
                <p>Valor para conversão: R$ ${data.amount}</p>
                <p>Forma de pagamento: ${data.payment_method}</p>
                <p>Valor da moeda de destino usado para conversão: ${data.conversion_rate}</p>
                <p>Valor comprado em moeda de destino: ${data.converted_amount}</p>
                <p>Taxa de pagamento: R$ ${data.payment_fee}</p>
                <p>Taxa de conversão: R$ ${data.conversion_fee}</p>
                <p>Valor utilizado para conversão descontando as taxas: R$ ${data.amount_after_fees}</p>
            `;
        })
        .catch(error => console.error('Error:', error));
});
