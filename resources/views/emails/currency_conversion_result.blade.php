<!DOCTYPE html>
<html>
<head>
    <title>Resultado da Cotação</title>
</head>
<body>
<p>Moeda de Origem: {{ $result['source_currency'] }}</p>
<p>Moeda de Destino: {{ $result['destination_currency'] }}</p>
<p>Valor para Conversão: R$ {{ number_format($result['amount'], 2, ',', '.') }}</p>
<p>Forma de Pagamento: {{ $result['payment_method'] }}</p>
<p>1 {{ $result['source_currency'] }} = {{ $result['destination_currency'] }} {{ $result['rate'] }}</p>
<p>Valor
    Convertido: {{ $result['destination_currency'] }} {{ number_format($result['converted_amount'], 2, ',', '.') }}</p>
<p>Taxa de Pagamento: R$ {{ number_format($result['tax_payment'], 2, ',', '.') }}</p>
<p>Taxa de Conversão: R$ {{ number_format($result['tax_conversion'], 2, ',', '.') }}</p>
<p>Valor Utilizado para Conversão (descontando as taxas):
    R$ {{ number_format($result['amount_after_taxes'], 2, ',', '.') }}</p>
</body>
</html>
