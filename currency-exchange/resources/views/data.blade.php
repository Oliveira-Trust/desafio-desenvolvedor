<!-- resources/views/data.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>API Data</title>
</head>
<body>
<h1>API Data</h1>

<p><strong>Code:</strong> {{ $data['BRLUSD']['code'] }}</p>
<p><strong>Name:</strong> {{ $data['BRLUSD']['name'] }}</p>
<p><strong>High:</strong> {{ $data['BRLUSD']['high'] }}</p>
<p><strong>Low:</strong> {{ $data['BRLUSD']['low'] }}</p>
<p><strong>Bid:</strong> {{ $data['BRLUSD']['bid'] }}</p>
<p><strong>Ask:</strong> {{ $data['BRLUSD']['ask'] }}</p>
<p><strong>Timestamp:</strong> {{ $data['BRLUSD']['timestamp'] }}</p>
<p><strong>Create Date:</strong> {{ $data['BRLUSD']['create_date'] }}</p>

<!-- Example: Button to trigger currency exchange -->
<form method="POST" action="{{ route('exchange') }}">
    @csrf
    <input type="hidden" name="amount" value="100">
    <button type="submit">Exchange Currency</button>
</form>
</body>
</html>
