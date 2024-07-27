<!DOCTYPE html>
<html>
<head>
    <title>Resultado da Conversão</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="main">
    <div class="container-result">
        <h1>Resultado da Conversão</h1>
        <p>Moeda de Origem: BRL</p>
        <p>Moeda de Destino: {{ $currency }}</p>
        <p>Valor para Conversão: R$ {{ number_format($amount, 2, ',', '.') }}</p>
        <p>Forma de Pagamento: {{ $payment_method == 'boleto' ? 'Boleto' : 'Cartão de Crédito' }}</p>
        <p>Valor de cotação da moeda {{$currency}} usado para conversão: $ {{ $conversion_rate }}</p>
        <p>Valor comprado em {{$currency}} : $ {{ number_format($converted_amount, 2, ',', '.') }}</p>
        <p>Taxa de pagamento: R$ {{ number_format($payment_fee_amount, 2, ',', '.') }}</p>
        <p>Taxa de conversão: R$ {{ number_format($conversion_fee_amount, 2, ',', '.') }}</p>
        <p>Valor utilizado para conversão descontando as taxas: R$ {{ number_format($net_amount, 2, ',', '.') }}</p>
    </div>    
</body>
</html>
