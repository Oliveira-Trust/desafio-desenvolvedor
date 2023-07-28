<!DOCTYPE html>
<html>
<head>
    <title>User Quotations</title>
</head>
<body>
    <h1>User Quotations</h1>
    <p>User Information:</p>
    <p>Name: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>ID: {{ $user->id }}</p>

    <h2>Quotations:</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Currency Origin</th>
                <th>Currency Destination</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach ($quotations as $quotation)
            <tr>
                <td>{{ $quotation->id }}</td>
                <td>{{ $quotation->currency_origin }}</td>
                <td>{{ $quotation->currency_destination }}</td>
                <td>{{ $quotation->amount }}</td>
                <td>{{ $quotation->payment_method }}</td>
                <!-- Add more columns as needed -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
