<!DOCTYPE html>
<html>
<head>
    <title>Conversão de Moeda</title>
</head>
<body>
    <h2>Conversão de Moeda</h2>
    <!-- Formulário para a entrada dos dados -->
    <form action="{{ route('currency.convert') }}" method="POST">
        @csrf
        <!-- Campos do formulário -->
        <label for="currency_destination">Moeda de Destino:</label>
        <select name="currency_destination" id="currency_destination">
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
            <option value="BTC">BTC</option>
        </select>
        <br>
        <label for="amount">Valor para Conversão (R$):</label>
        <input type="number" name="amount" id="amount" step="0.01" min="1000" max="100000">
        <br>
        <label for="payment_method">Forma de Pagamento:</label>
        <select name="payment_method" id="payment_method">
            <option value="Boleto">Boleto</option>
            <option value="Cartão de Crédito">Cartão de Crédito</option>
        </select>
        <br>
        <button type="submit">Converter</button>
    </form>
</body>
</html>
