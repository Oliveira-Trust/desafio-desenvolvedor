<!-- resources/views/currency-exchange.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Currency Exchange</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script>
        // Function to format input value as currency
        function formatCurrency(input) {
            // Remove non-digit characters and limit to 8 digits
            input = input.replace(/\D/g, '').substring(0, 8);

            // Convert to integer and format as cents
            let cents = parseInt(input) / 100;

            // Update the input field with formatted value
            return cents.toFixed(2);
        }

        // Function to update converted transaction value
        function updateConvertedValue(inputElement, conversionRate) {
            let inputValue = parseFloat(inputElement.value) || 0;
            let convertedValue = (inputValue * conversionRate).toFixed(2);
            let row = inputElement.closest('tr');
            let convertedValueCell = row.querySelector('.converted-value');
            convertedValueCell.textContent = convertedValue;
        }
    </script>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Currency Exchange Rates</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Currency</th>
            <th scope="col">High</th>
            <th scope="col">Low</th>
            <th scope="col">Bid</th>
            <th scope="col">Ask</th>
            <th scope="col">Change</th>
            <th scope="col">Currency amount</th>
            <th scope="col">BRL price</th>
            <th scope="col">More Info</th>
        </tr>
        </thead>
        <tbody>
        @foreach($currencyData as $key => $data)
            <tr>
                <td>{{ $data['name'] }}</td>
                <td>{{ number_format($data['high'], 2) }}</td>
                <td>{{ number_format($data['low'], 2) }}</td>
                <td>{{ number_format($data['bid'], 2) }}</td>
                <td>{{ number_format($data['ask'], 2) }}</td>
                <td>{{ number_format($data['pctChange'], 2) }}%</td>
                <td>
                    <input type="text" class="form-control" placeholder="Enter value in cents"
                           oninput="this.value = formatCurrency(this.value); updateConvertedValue(this, {{ 1 / $data['bid'] }})">
                </td>
                <td class="converted-value">0.00</td>
                <td><a href="#" class="btn btn-primary btn-sm">Exchange {{$data['code']}}-{{$data['codein']}}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
