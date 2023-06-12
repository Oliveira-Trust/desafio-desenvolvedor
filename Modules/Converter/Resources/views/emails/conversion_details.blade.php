<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333333;
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #dddddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Olá {{ $conversion->user->name }},</h1>
        <p>Aqui estão as informações de conversão de moeda:</p>
        <table>
            <tr>
                <th>Descrição</th>
                <th>Valor</th>
            </tr>
            <tr>
                <td>Moeda de origem</td>
                <td>BRL</td>
            </tr>
            <tr>
                <td>Moeda de destino</td>
                <td>{{ $conversion->destination_currency }}</td>
            </tr>
            <tr>
                <td>Valor para conversão</td>
                <td>{{ $conversion->value_to_convert }}</td>
            </tr>
            <tr>
                <td>Forma de pagamento</td>
                <td>{{ $conversion->payment_method }}</td>
            </tr>
            <tr>
                <td>Valor da {{ $conversion->destination_currency }}</td>
                <td>{{ $conversion->destination_currency_value }}</td>
            </tr>
            <tr>
                <td>Valor comprado em {{ $conversion->destination_currency }}</td>
                <td>{{ $conversion->purchase_value }}</td>
            </tr>
            <tr>
                <td>Taxa de pagamento</td>
                <td>{{ $conversion->payment_fee }}</td>
            </tr>
            <tr>
                <td>Taxa de conversão</td>
                <td>{{ $conversion->conversion_fee }}</td>
            </tr>
            <tr>
                <td>Valor utilizado para conversão</td>
                <td>{{ $conversion->final_conversion_value }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
