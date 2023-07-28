<!DOCTYPE html>
<html>
<head>
    <title>Currency Conversion</title>
</head>
<body>

    <!-- Email Input -->
    <div class="mb-4">
        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
        <input type="email" name="email" id="email" class="form-input rounded-md shadow-sm mt-1 block w-full"
            value="{{ old('email') }}" required>
        @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <h2>Currency Conversion</h2>

    <!-- Form for data input -->
    <form action="{{ route('currency.convert') }}" method="POST">
        @csrf
        <!-- Form fields -->
        <label for="currency_destination">Destination Currency:</label>
        <select name="currency_destination" id="currency_destination">
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
            <option value="BTC">BTC</option>
        </select>
        <br>
        <label for="amount">Conversion Amount (R$):</label>
        <input type="number" name="amount" id="amount" step="0.01" min="1000" max="100000">
        <br>
        <label for="payment_method">Payment Method:</label>
        <select name="payment_method" id="payment_method">
            <option value="Boleto">Boleto</option>
            <option value="Cartão de Crédito">Cartão de Crédito</option>
        </select>
        <br>
        <button type="submit">Convert</button>
    </form>
</body>
</html>
