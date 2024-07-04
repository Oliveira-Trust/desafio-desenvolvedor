!DOCTYPE html>
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
    <li>Value: {{ $conversion['value'] }}</li>
    <li>Payment Fee: {{ $conversion['payment_fee'] }}</li>
    <li>Conversion Fee: {{ $conversion['conversion_fee'] }}</li>
    <li>Effective Value: {{ $conversion['effective_value'] }}</li>
</ul>
</body>
</html>
