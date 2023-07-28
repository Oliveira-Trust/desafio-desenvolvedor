<!DOCTYPE html>
<html>
<head>
    <title>Successful Currency Quotation</title>
</head>
<body>
    <h2>Successful Currency Quotation</h2>
    <p>Hello, {{ $userName }}!</p>
    <p>Your quotation was successful. Below are the quotation details:</p>

    <!-- Displaying the quotation details -->
    <p><strong>Original Currency:</strong> {{ $currencyOrigin }}</p>
    <p><strong>Destination Currency:</strong> {{ $currencyDestination }}</p>
    <p><strong>Original Currency Amount:</strong> R$ {{ number_format($amount, 2, ',', '.') }}</p>
    <p><strong>Payment Method:</strong> {{ $paymentMethod }}</p>
    <p><strong>Payment Tax:</strong> R$ {{ number_format($paymentTax, 2, ',', '.') }}</p>
    <p><strong>Conversion Tax:</strong> {{ number_format($conversionTax * 100, 2, ',', '.') }}%</p>
    <p><strong>Total Amount with Taxes:</strong> R$ {{ number_format($amountWithConversionTax, 2, ',', '.') }}</p>
    <p><strong>Destination Currency Exchange Rate:</strong> R$ {{ number_format($conversionRate, 2, ',', '.') }}</p>
    <p><strong>Foreign Currency Amount:</strong> R$ {{ number_format($foreignAmount, 2, ',', '.') }}</p>

    <p>Thank you for using our service!</p>
</body>
</html>
