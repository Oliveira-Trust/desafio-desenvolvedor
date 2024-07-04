<!DOCTYPE html>
<html>
<head>
    <title>Conversion Created</title>
</head>
<body>
<h1>Conversion Created</h1>
<p>A new conversion has been created with the following details:</p>
<ul>
    <li>Base Currency: {{ $conversion['base_currency'] }}</li>
    <li>Target Currency: {{ $conversion['target_currency'] }}</li>
    <li>Value: R${{ number_format($conversion['value']), 2 }}</li>
    <li>Payment Fee: R${{ $conversion['payment_fee'] }}</li>
    <li>Conversion Fee: R${{ $conversion['conversion_fee'] }}</li>
    <li>Effective Value: R${{ $conversion['effective_value'] }}</li>
    <li>{{ $conversion['target_currency'] }} Bought: {{ $conversion['purchased_value'] }}</li>
</ul>
</body>
</html>
