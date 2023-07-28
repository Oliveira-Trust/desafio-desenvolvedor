<!DOCTYPE html>
<html>
<head>
    <title>Cotação Realizada</title>
</head>
<body>
    <h1>Cotação Realizada</h1>
    <p>Segue abaixo os detalhes da cotação realizada:</p>
    <ul>
        <li>Moeda de Origem: {{ $currencyOrigin }}</li>
        <li>Moeda de Destino: {{ $currencyDestination }}</li>
        <li>Valor para Conversão: {{ $amount }}</li>
        <li>Forma de Pagamento: {{ $paymentMethod }}</li>
        <li>Taxa de Pagamento: {{ $paymentTax }}%</li>
        <li>Taxa de Conversão: {{ $conversionTax }}%</li>
        <li>Valor da Compra com Taxas: {{ $amountWithConversionTax }}</li>
        <li>Cotação da Moeda de Destino: {{ $conversionRate }}</li>
        <li>Valor em Moeda Estrangeira: {{ $foreignAmount }}</li>
    </ul>
</body>
</html>
