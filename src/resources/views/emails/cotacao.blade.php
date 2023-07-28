<!DOCTYPE html>
<html>
<head>
    <title>Performed Quotation</title>
</head>
<body>
    <h1>Performed Quotation</h1>
    <p>Below are the details of the performed quotation:</p>
    <ul>
        <!-- Displaying the quotation details in a list format -->
        <li>Original Currency: {{ $currencyOrigin }}</li>
        <li>Destination Currency: {{ $currencyDestination }}</li>
        <li>Conversion Amount: {{ $amount }}</li>
        <li>Payment Method: {{ $paymentMethod }}</li>
        <li>Payment Tax: {{ $paymentTax }}%</li>
        <li>Conversion Tax: {{ $conversionTax }}%</li>
        <li>Purchase Amount with Taxes: {{ $amountWithConversionTax }}</li>
        <li>Destination Currency Exchange Rate: {{ $conversionRate }}</li>
        <li>Foreign Currency Amount: {{ $foreignAmount }}</li>
    </ul>
</body>
</html>
