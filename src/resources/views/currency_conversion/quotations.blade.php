<!DOCTYPE html>
<html>
<head>
    <title>User Quotations</title>
</head>
<body>
    <h1>User Quotations</h1>
    @foreach ($quotations as $quotation)
        <p><strong>Quotation ID:</strong> {{ $quotation->id }}</p>
        <p><strong>Destination Currency:</strong> {{ $quotation->currency_destination }}</p>
        <p><strong>Amount:</strong> R$ {{ number_format($quotation->amount, 2, ',', '.') }}</p>
        <!-- Add other details you want to display for each quotation -->
        <hr>
    @endforeach
</body>
</html>
