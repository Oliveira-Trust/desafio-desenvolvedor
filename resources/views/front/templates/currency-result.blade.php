@if (session()->has('result'))
    <div class="alert alert-success mb-4" role="alert">
        <h3 class="text-center pb-2">Resultado</h3>

        <ul class="list-group list-group-flush">
            <li class="list-group-item">Moeda de origem: BRL</li>
            <li class="list-group-item">Moeda de destino: {{ session('result')['currency'] }}</li>
            <li class="list-group-item">Valor para conversão: {{ currencyFormat(session('result')['inputValue'], 'R$') }}</li>
            <li class="list-group-item">Forma de pagamento: {{ config("payment_methods." . session('result')['paymentMethod'] . ".display_name") }}</li>
            <li class="list-group-item">Valor da "Moeda de destino" usado para conversão: {{ currencyFormat(session('result')['currencyQuote'], '$') }}</li>
            <li class="list-group-item">Valor comprado em "Moeda de destino": {{ currencyFormat(session('result')['convertedValue'], '$') }}</li>
            <li class="list-group-item">Taxa de pagamento: {{ currencyFormat(session('result')['paymentFullFee'], 'R$') }}</li>
            <li class="list-group-item">Taxa de conversão: {{ currencyFormat(session('result')['conversionFullFee'], 'R$') }}</li>
            <li class="list-group-item">Valor utilizado para conversão descontando as taxas: {{ currencyFormat(session('result')['valueToConvert'], 'R$') }}</li>
        </ul>
    </div>
@endif
