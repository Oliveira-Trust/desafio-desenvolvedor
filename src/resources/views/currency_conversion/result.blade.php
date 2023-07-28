<!DOCTYPE html>
<html>
<head>
    <title>Conversion Result</title>
</head>
<body>
    <h2>Conversion Result</h2>
    <!-- Displaying the currency details -->
    <p>Original Currency: {{ $currencyOrigin }}</p>
    <p>Destination Currency: {{ $currencyDestination }}</p>
    <p>Conversion Amount: R$ {{ $amount }}</p>
    <p>Payment Method: {{ $paymentMethod }}</p>
    <p>Payment Tax: {{ $paymentTax }}%</p>
    <p>Conversion Tax: {{ $conversionTax }}%</p>
    <p>Purchase Amount with Taxes: R$ {{ $amountWithConversionTax }}</p>
    <p>Destination Currency Exchange Rate: {{ $conversionRate }}</p>
    <p>Foreign Currency Amount: {{ $foreignAmount }}</p>
</body>
</html>
