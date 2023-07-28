<!DOCTYPE html>
<html>
<head>
    <title>Cotação Realizada com Sucesso</title>
</head>
<body>
    <h2>Cotação Realizada com Sucesso</h2>
    <p>Olá, {{ $userName }}!</p>
    <p>Sua cotação foi realizada com sucesso. Abaixo estão os detalhes da cotação:</p>

    <p><strong>Moeda de Origem:</strong> {{ $currencyOrigin }}</p>
    <p><strong>Moeda de Destino:</strong> {{ $currencyDestination }}</p>
    <p><strong>Valor em Moeda de Origem:</strong> R$ {{ number_format($amount, 2, ',', '.') }}</p>
    <p><strong>Método de Pagamento:</strong> {{ $paymentMethod }}</p>
    <p><strong>Taxa de Pagamento:</strong> R$ {{ number_format($paymentTax, 2, ',', '.') }}</p>
    <p><strong>Taxa de Conversão:</strong> {{ number_format($conversionTax * 100, 2, ',', '.') }}%</p>
    <p><strong>Valor Total com Taxas:</strong> R$ {{ number_format($amountWithConversionTax, 2, ',', '.') }}</p>
    <p><strong>Taxa de Conversão:</strong> R$ {{ number_format($conversionRate, 2, ',', '.') }}</p>
    <p><strong>Valor em Moeda Estrangeira:</strong> {{ number_format($foreignAmount, 2, ',', '.') }}</p>

    <p>Obrigado por utilizar nosso serviço!</p>
</body>
</html>
