<!-- resources/views/emails/quote.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cotação</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin-bottom: 20px;
        }

        li {
            margin-bottom: 10px;
        }

        p {
            margin-bottom: 10px;
        }

        .signature {
            margin-top: 20px;
            font-size: 14px;
            color: #999999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cotação</h1>

        <p>Olá,</p>

        <p>Aqui está a cotação que você solicitou:</p>

        <ul>
            <li>Moeda de origem: {{ $origin_currency }}</li>
            <li>Moeda de destino: {{ $destination_currency }}</li>
            <li>Valor original: {{ $original_value }}</li>
            <li>Método de pagamento: {{ $payment_method }}</li>
        </ul>

        <h3>Detalhes da Conversão</h3>
        <ul>
            <li>Valor original: {{ $conversion_details['original_amount'] }}</li>
            <li>Valor convertido: {{ $conversion_details['converted_amount'] }}</li>
            <li>Taxa de câmbio: {{ $conversion_details['exchange_rate'] }}</li>
        </ul>

        <h3>Detalhes da Taxa</h3>
        <ul>
            <li>Taxa fixa: {{ $tax['tax_rate_value'] }}</li>
            <li>Taxa de conversão: {{ $tax['tax_conversion_value'] }}</li>
            <li>Taxa total: {{ $tax['tax_total'] }}</li>
        </ul>

        <p>Valor original (menos taxas): {{ $original_value_minus_tax }}</p>

        <p class="signature">Atenciosamente,<br>
        {{ config('app.name') }}</p>
    </div>
</body>
</html>
