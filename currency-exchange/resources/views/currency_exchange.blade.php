<!-- resources/views/currency-exchange.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Currency Exchange</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-bottom: 20px;
        }
        .table thead th {
            background-color: #007bff;
            color: #fff;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .converted-value {
            font-weight: bold;
        }
        .btn-exchange {
            background-color: #28a745;
            color: #fff;
        }
    </style>
    <script>
        function formatCurrency(input) {
            input = input.replace(/\D/g, '').substring(0, 8);
            let cents = parseInt(input) / 100;
            return cents.toFixed(2);
        }

        function updateConvertedValue(inputElement, conversionRate) {
            let inputValue = parseFloat(inputElement.value) || 0;
            let convertedValue = (inputValue / conversionRate).toFixed(2);
            let row = inputElement.closest('tr');
            let convertedValueCell = row.querySelector('.converted-value');
            convertedValueCell.textContent = convertedValue;
        }
    </script>
</head>
<body>
<div class="container mt-5">
    <h1>Exchange History</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Base Currency</th>
            <th scope="col">Target Currency</th>
            <th scope="col">Value</th>
            <th scope="col">Payment Method ID</th>
            <th scope="col">Target Currency Value</th>
            <th scope="col">Payment Method Fee</th>
            <th scope="col">Conversion Fee</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($conversion as $t)
            <tr>
                <td>{{ $t->base_currency }}: R${{ number_format($t->value, 2) }}</td>
                <td>{{ $t->target_currency }}: {{ number_format($t->purchased_value, 2) }}</td>
                <td>{{ $t->base_currency }}: R${{ number_format($t->effective_value, 2) }}</td>
                <td>{{ $t->payment_method_id == 1 ? "Boleto" : "Cartão de Crédito" }}</td>
                <td>{{ $t->target_currency_value }}</td>
                <td>{{ number_format($t->payment_fee, 2) }}</td>
                <td>{{ number_format($t->conversion_fee, 2) }}</td>
                <td>{{ $t->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <x-validation-errors class="px-4 sm:px-6 mb-4" :errors="$errors" />
    <x-success-message />

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
            <th scope="col">Payment Method</th>
            <th scope="col">BRL</th>
            <th scope="col">Amount</th>
            <th scope="col">Buy</th>
        </tr>
        </thead>
        <tbody>
        @foreach($currencyData as $key => $data)
            <form action="{{ route('currency-exchanges.create') }}" method="POST">
                @csrf
                <input type="hidden" id="base_currency" name="base_currency" value="{{$data['code']}}">
                <input type="hidden" id="target_currency" name="target_currency" value="{{$data['codein']}}">
                <tr>
                    <td>{{ $data['name'] }}</td>
                    <td>{{ number_format($data['high'], 2) }}</td>
                    <td>{{ number_format($data['low'], 2) }}</td>
                    <td>{{ number_format($data['bid'], 2) }}</td>
                    <td>{{ number_format($data['ask'], 2) }}</td>
                    <td>{{ number_format($data['pctChange'], 2) }}%</td>
                    <td>
                        <select class="form-control" name="payment_method">
                            @foreach($paymentMethod as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control" placeholder="Enter value in cents" name="value" id="value"
                               oninput="this.value = formatCurrency(this.value); updateConvertedValue(this, {{ 1 / $data['bid'] }})">
                    </td>
                    <td class="converted-value">0.00</td>
                    <td><button type="submit" class="btn btn-exchange">Exchange</button></td>
                </tr>
            </form>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
