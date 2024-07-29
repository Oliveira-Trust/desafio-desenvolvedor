<!DOCTYPE html>
<html>

<head>
    <title>Conversor de Moedas</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">  
</head>
<body>
    <div class="container">
        <h1>Conversão de Moeda</h1>        
        <div id="error-container"></div>
        <form id="conversionForm">
            @csrf
            <div>
                <label for="amount">Valor para Conversão:</label>
                <input placeholder="(BRL)" type="number" name="amount" id="amount" required>
            </div>
            <div>
                <label for="destination_currency">Moeda de Destino:</label>
                <select name="destination_currency" id="destination_currency" required>
                    <option value="USD">USD</option>
                    <option value="GBP">GBP</option>
                    <option value="JPY">JPY</option>
                    <option value="EUR">EUR</option>
                </select>
            </div>
            <div>
                <label for="payment_method">Forma de Pagamento:</label>
                <select name="payment_method" id="payment_method" required>
                    <option value="boleto">Boleto</option>
                    <option value="credit_card">Cartão de Crédito</option>
                </select>
            </div>
            <button type="submit">Converter</button>
        </form>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        function getJwtToken() {
            return localStorage.getItem('jwtToken');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('conversionForm');
            const errorContainer = document.getElementById('error-container');

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                const amount = parseFloat(document.getElementById('amount').value);
                const destinationCurrency = document.getElementById('destination_currency').value;
                const paymentMethod = document.getElementById('payment_method').value;
           
                if (errorContainer) {
                    errorContainer.innerHTML = '';
                }
                let hasError = false;

                if (amount < 1000) {
                    errorContainer.innerHTML += '<p class="error-message">O valor deve ser maior que R$1000,00.</p>';
                    hasError = true;
                }
                if (amount > 100000) {
                    errorContainer.innerHTML += '<p class="error-message">O valor deve ser menor que R$100.000,00.</p>';
                    hasError = true;
                }

                if (hasError) {
                    return;
                }               
                fetch('{{ url('api/convert') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': `Bearer ${getJwtToken()}`,
                        },
                        body: JSON.stringify({
                            amount: amount,
                            destination_currency: destinationCurrency,
                            payment_method: paymentMethod
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Resposta recebida:', data); 

                        if (data.success) {                       
                            const queryString = new URLSearchParams(data.data).toString();
                            window.location.href = `{{ route('conversion-results') }}?${queryString}`;
                        } else {
                            if (errorContainer) {
                                errorContainer.innerHTML = `<p class="error-message">${data.message}</p>`;
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        if (errorContainer) {
                            errorContainer.innerHTML = '<p class="error-message">Erro ao processar a solicitação.</p>';
                        }
                    });
            });
        });
    </script>
</body>

</html>
