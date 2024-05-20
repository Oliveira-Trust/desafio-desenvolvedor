<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cotação</title>
    <style>
        /* Fonte importada do Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f0f2f5;
            padding: 20px;
            margin: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        }

        h1 {
            color: #007BFF;
            font-size: 28px;
            text-align: center;
            margin-bottom: 25px;
            font-weight: 700;
        }

        p {
            font-size: 16px;
            color: #333333;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .quote-section {
            margin-bottom: 30px;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
            border: 1px solid #e0e0e0;
            transition: background-color 0.3s, border 0.3s;
        }

        .quote-section:hover {
            background-color: #f1f1f1;
            border: 1px solid #d1d1d1;
        }

        .quote-section h3 {
            font-size: 20px;
            color: #007BFF;
            margin-bottom: 15px;
            font-weight: 500;
        }

        .quote-section ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .quote-section li {
            font-size: 16px;
            color: #555555;
            margin-bottom: 10px;
        }

        .quote-section li strong {
            color: #333333;
            font-weight: 500;
        }

        .signature {
            font-size: 14px;
            color: #999999;
            text-align: center;
            margin-top: 40px;
        }

        /* Botão de ação */
        .action-button {
            display: block;
            width: 100%;
            max-width: 200px;
            margin: 20px auto;
            padding: 12px 20px;
            text-align: center;
            background-color: #007BFF;
            color: #ffffff;
            border: none;
            border-radius: 25px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s, transform 0.3s;
        }

        .action-button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        /* Media queries para dispositivos móveis */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 24px;
            }

            p {
                font-size: 14px;
            }

            .quote-section h3 {
                font-size: 18px;
            }

            .quote-section li {
                font-size: 14px;
            }

            .signature {
                font-size: 12px;
            }

            .action-button {
                font-size: 14px;
                padding: 10px 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cotação #{{ $quote_id }}</h1>

        <p>Olá, {{ $username }}</p>
        <p>Aqui está a cotação que você solicitou:</p>

        <div class="quote-section">
            <h3>Detalhes da Cotação</h3>
            <ul>
                <li><strong>Moeda de origem:</strong> {{ $origin_currency_name }} ({{ $origin_currency }})</li>
                <li><strong>Moeda de destino:</strong> {{ $destination_currency_name }} ({{ $destination_currency }})</li>
                <li><strong>Valor original:</strong> {{ $original_value }}</li>
                <li><strong>Método de pagamento:</strong> {{ ($payment_method == 'CreditCard') ? "Cartão de Credito" : $payment_method }}</li>
            </ul>
        </div>

        <div class="quote-section">
            <h3>Detalhes da Conversão</h3>
            <ul>
                <li><strong>Valor original:</strong> {{ $conversion_details['original_amount'] }}</li>
                <li><strong>Valor convertido:</strong> {{ $conversion_details['converted_amount'] }}</li>
                <li><strong>Taxa de câmbio:</strong> {{ $conversion_details['exchange_rate'] }}</li>
            </ul>
        </div>

        <div class="quote-section">
            <h3>Detalhes da Taxa</h3>
            <ul>
                <li><strong>Taxa fixa:</strong> {{ $tax['tax_rate_value'] }}</li>
                <li><strong>Taxa de conversão:</strong> {{ $tax['tax_conversion_value'] }}</li>
                <li><strong>Taxa total:</strong> {{ $tax['tax_total'] }}</li>
            </ul>
        </div>

        <p><strong>Valor original (menos taxas):</strong> {{ $original_value_minus_tax }}</p>
        <p><strong>Gerando em :</strong> {{ $data }}</p>

        <a href="#" class="action-button">Ver Mais Detalhes</a>

        <p class="signature">
            Atenciosamente,<br>
            {{ config('app.name') }}
        </p>
    </div>
</body>
</html>
