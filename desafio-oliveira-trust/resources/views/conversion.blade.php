<!DOCTYPE html>
<html>
<head>
    <title>Conversor de Moedas</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Conversão de Moeda</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ url('/convert') }}" method="POST">
            @csrf
            <div>
                <label for="amount">Valor para Conversão:</label>
                <input placeholder="(BRL)" type="number" name="amount" id="amount">
            </div>
            <div>
                <label for="currency">Moeda de Destino:</label>
                <select name="currency" id="currency" required>
                    <option value="USD">USD</option>
                    <option value="GBP">GBP</option>
                    <option value="JPY">JPY</option>
                    <option value="EUR">EUR</option>
                </select>
            </div>            
            <div>
                <label for="payment_method">Forma de Pagamento:</label>
                <select name="payment_method" id="payment_method" required>
                    <option value="boleto">Boleto</option>
                    <option value="credit_card">Cartão de Crédito</option>
                </select>
            </div>
            <button type="submit">Converter</button>
        </form>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
