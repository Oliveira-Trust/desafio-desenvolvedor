<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body class="flex items-center justify-center bg-gray-100">
<h1>Hi {{ $name }} you have a new conversion created!</h1>
<p>A new conversion has been created!</p>
<ul>
    <li>Moeda de origem: {{ $currency_origin }}</li>
    <li>Moeda de destino: {{ $currency_destination }}</li>
    <li>Valor para conversão: R$ {{ $amount }}</li>
    <li>Forma de pagamento: R$ {{ $payment }}</li>
    <li>Valor da "Moeda de destino" usado para conversão: {{ $currency_origin }} {{ $rate }}</li>
    <li>Valor comprado em "Moeda de destino": R$ {{ $total_converted }}</li>
    <li>Taxa de pagamento: {{ $payment_tax }}</li>
    <li>Taxa de conversão: {{ $conversion_tax }}</li>
    <li>Valor utilizado para conversão descontando as taxas: {{ $value_of_purchased }}</li>
</ul>
</body>
</html>
