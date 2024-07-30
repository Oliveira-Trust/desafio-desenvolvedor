<!DOCTYPE html>
<html>
<head>
    <title>Cotação Realizada</title>
</head>
<body>
<h1>Cotação Realizada</h1>
<p>Detalhes da cotação:</p>
<ul>
    <li>Moeda de Origem: {{ $quotation->source_currency }}</li>
    <li>Moeda de Destino: {{ $quotation->target_currency }}</li>
    <li>Valor Original: {{ $quotation->original_amount }}</li>
    <li>Taxa de Pagamento: {{ $quotation->payment_fee }}</li>
    <li>Taxa de Conversão: {{ $quotation->conversion_fee }}</li>
    <li>Valor Convertido: {{ $quotation->converted_amount }}</li>
    <li>Valor Final: {{ $quotation->final_amount }}</li>
</ul>
</body>
</html>
