<!DOCTYPE html>
<html>
<head>
    <title>Resultado da Conversão</title>
</head>
<body>
    <h2>Resultado da Conversão</h2>
    <p>Moeda de Origem: {{ $currencyOrigin }}</p>
    <p>Moeda de Destino: {{ $currencyDestination }}</p>
    <p>Valor para Conversão: R$ {{ $amount }}</p>
    <p>Forma de Pagamento: {{ $paymentMethod }}</p>
    <p>Taxa de Pagamento: {{ $paymentTax }}%</p>
    <p>Taxa de Conversão: {{ $conversionTax }}%</p>
    <p>Valor da Compra com Taxas: R$ {{ $amountWithConversionTax }}</p>
    <p>Cotação da Moeda de Destino: {{ $conversionRate }}</p>
    <p>Valor em Moeda Estrangeira: {{ $foreignAmount }}</p>
</body>
</html>
