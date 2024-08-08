document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('convertForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const destinyCoin = document.getElementById('destinyCoin').value;
        const amount = document.getElementById('valueForConversion').value;
        const paymentMethod = document.getElementById('paymentMethod').value;
        const formData = new FormData();

        formData.append('destinyCoin', destinyCoin);
        formData.append('amount', amount);
        formData.append('paymentMethod', paymentMethod);

        if(amount > 1000) {
            document.getElementById('loadingOverlay').style.display = 'flex';
        }

        fetch('../../src/api/conversion.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let paymentMethodPTBR,
                        symbolDestinyCoin,
                        symbolBrazilianCoin = 'R$ ';

                    switch (data.paymentMethod) {
                        case 'bankSlip':
                            paymentMethodPTBR = 'Boleto';
                            break;
                        case 'creditCard':
                            paymentMethodPTBR = 'Cartão de Crédito';
                            break;
                        default:
                            paymentMethodPTBR = 'Metodo de pagamento inválido';
                            break;
                    }

                    switch (data.destinyCoin) {
                        case 'EUR':
                            symbolDestinyCoin = '<i class="fa-solid fa-euro-sign"></i> ';
                            break;
                        case 'USD':
                            symbolDestinyCoin = '<i class="fa-solid fa-dollar-sign"></i> ';
                            break;
                        case 'BTC':
                            symbolDestinyCoin = '<i class="fa-brands fa-bitcoin"></i> ';
                            break;
                        default:
                            symbolDestinyCoin = '<i class="fa-solid fa-money-bill"></i> ';
                            break;
                    }


                    document.getElementById('originalCoinValue').innerText = data.originalCoin;

                    let elementsDestinyCoin = document.getElementsByClassName('destinyCoinValue');
                    for (let i = 0; i < elementsDestinyCoin.length; i++) {
                        elementsDestinyCoin[i].innerText = data.destinyCoin;
                    }

                    document.getElementsByClassName('destinyCoinValue').innerText =  data.destinyCoin;
                    document.getElementById('amountValue').innerHTML = symbolBrazilianCoin + data.amount.toFixed(2).replace('.', ',');
                    document.getElementById('paymentMethodSelected').innerText = paymentMethodPTBR;
                    document.getElementById('bid').innerHTML = symbolDestinyCoin + parseFloat(data.bid).toFixed(2).replace('.', ',');

                    let formattedPurchasedValue;
                    if (data.destinyCoin === 'BTC') {
                        formattedPurchasedValue = data.purchasedValue.toString().replace('.', ',');
                    } else {
                        formattedPurchasedValue = data.purchasedValue.toFixed(2).replace('.', ',');
                    }
                    document.getElementById('purchasedValue').innerHTML = symbolDestinyCoin + formattedPurchasedValue;
                    document.getElementById('paymentTax').innerHTML = symbolBrazilianCoin + data.paymentTax.toFixed(2).replace('.', ',');
                    document.getElementById('convertTax').innerHTML = symbolBrazilianCoin + data.convertTax.toFixed(2).replace('.', ',');
                    document.getElementById('liquidValueBRL').innerHTML = symbolBrazilianCoin + data.liquidValue.toFixed(2).replace('.', ',');
                    document.getElementById('resultDataConvert').classList.remove('hide');
                } else {
                    alert('Erro na conversão: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erro:', error);
            })
            .finally(() => {
                document.getElementById('loadingOverlay').style.display = 'none';
            });
    });

    document.getElementById('clearForm').addEventListener('click', function() {
        document.getElementById('resultDataConvert').classList.add('hide');

        document.getElementById('originalCoinValue').innerText = data.originalCoin;

        let elementsDestinyCoin = document.getElementsByClassName('destinyCoinValue');
        for (let i = 0; i < elementsDestinyCoin.length; i++) {
            elementsDestinyCoin[i].innerText = '';
        }

        document.getElementsByClassName('destinyCoinValue').innerText = '';
        document.getElementById('amountValue').innerHTML = '';
        document.getElementById('paymentMethodSelected').innerText = '';
        document.getElementById('bid').innerHTML =  '';
        document.getElementById('purchasedValue').innerHTML = '';
        document.getElementById('paymentTax').innerHTML = '';
        document.getElementById('convertTax').innerHTML = '';
        document.getElementById('liquidValueBRL').innerHTML = '';

    })
})

