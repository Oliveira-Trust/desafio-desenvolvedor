<!DOCTYPE html>
<html>

<head>
    <title>Resultado da Conversão</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="main">
    <div class="container-result">
        <h1>Conversion Result</h1>
        <p>Moeda de destino: {{ $destination_currency }}</p>
        <p>Valor para conversão: {{ number_format($amount, 2) }}</p>
        <p>Forma de pagamento: {{ $payment_method }}</p>
        <p>Valor em {{ $destination_currency }} usado para conversão: {{ number_format($conversion_rate, 2) }} </p>
        <p>Valor comprado em {{ $destination_currency }}:{{ number_format($converted_amount, 2) }} </p>        
        <p>Taxa de pagamento: {{ number_format($payment_fee, 2) }}</p>
        <p>Taxa de conversão: {{ number_format($conversion_fee, 2) }}</p>
        <p>Valor utilizado para conversão descontando as taxas: {{ number_format($net_amount, 2) }}</p>
        <div class="button-container">
            <form action="{{ route('sendEmail') }}" method="POST">
                @csrf
                <button type="submit">Enviar para Email</button>
            </form>
            
            <form action="{{ route('history') }}" method="GET">            
                <button type="submit">Exibir Histórico de Cotação</button>
            </form>
        </div>
    </div>
</body>

</html>
