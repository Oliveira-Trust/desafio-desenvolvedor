<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Conversão</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalhes da Conversão</h1>
        <p>Olá,</p>
        <p>Abaixo estão os detalhes da conversão realizada:</p>
        @php
            $symbol = 'R$ ';
            switch ($conversion->to) {
                case 'USD':
                    $symbol = '$ ';
                    break;
                case 'EUR':
                    $symbol = '€ ';
                    break;
                case 'GBP':
                    $symbol = '£ ';
                    break;
                default:
                    break;
            }
        @endphp
        <table>
            <tr>
                <th>Moeda Origem</th>
                <td>{{ $conversion->from }}</td>
            </tr>
            <tr>
                <th>Moeda Destino</th>
                <td>{{ $conversion->to }}</td>
            </tr>
            <tr>
                <th>Valor para Conversão</th>
                <td>R$ {{ number_format($conversion->amount, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Método de Pagamento</th>
                <td>{{ $conversion->payment_method == 'boleto' ? 'Boleto' : 'Cartão de Crédito' }}</td>
            </tr>
            <tr>
                <th>Valor da Moeda de Conversão</th>
                <td>{{ $symbol . number_format($conversion->currency_value, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Valor Comprado em Moeda de Conversão</th>
                <td>{{ $symbol . number_format($conversion->purchase_amount, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Taxa de Pagamento</th>
                <td>R$ {{ number_format($conversion->payment_rate, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Taxa de Conversão</th>
                <td>R$ {{ number_format($conversion->conversion_rate, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Valor Utilizado para Conversão sem as Taxas</th>
                <td>R$ {{ number_format($conversion->purchase_price_excluding_taxes, 2, ',', '.') }}</td>
            </tr>
        </table>
        
        <p>Se tiver alguma dúvida, entre em contato conosco.</p>
        
        <div class="footer">
            <p>Atenciosamente,</p>
            <p>Equipe de Suporte</p>
        </div>
    </div>
</body>
</html>
