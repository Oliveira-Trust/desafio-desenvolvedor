<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Informações sobre a cotação realizada</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            background-color: #343A40;
            text-align: left;
            color: white;
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h3 style="text-align: center;">Informações sobre a cotação realizada</h3>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Moeda de origem</td>
                    <td>BRL</td>
                </tr>
                <tr>
                    <td>Moeda de destino</td>
                    <td>{{ $dadosCotacao['moedaDestino'] }} {{ $dadosCotacao['nomeMoedaDestino'] }}</td>
                </tr>
                <tr>
                    <td>Valor moeda destino</td>
                    <td>1 BRL = {{ $dadosCotacao['taxaDeConversao'] }} {{ $dadosCotacao['nomeMoedaDestino'] }}</td>
                </tr>   
                <tr>
                    <td>Valor inicial em BRL para conversão</td>
                    <td>R$ {{ number_format($dadosCotacao['quantidade'], 2, ',', '.') }}</td>
                </tr>                                                     
                <tr>
                    <td>Taxa de pagamento</td>
                    <td>R$ {{ $dadosCotacao['taxaDePagamento'] }}</td>
                </tr>
                <tr>
                    <td>Taxa de conversão adicional</td>
                    <td>R$ {{ $dadosCotacao['taxaDeConversaoAdicional'] }}</td>
                </tr>                            
                <tr>
                    <td>Valor para conversão com as taxas aplicadas</td>
                    <td>R$ {{ $dadosCotacao['quantidadeAposTaxas'] }}</td>
                </tr>
                <tr>
                    <td>Valor comprado em {{ $dadosCotacao['nomeMoedaDestino'] }}</td>
                    <td>{{ $dadosCotacao['quantidadeConvertida'] }}</td>
                </tr>
                <tr>
                    <td>Forma de pagamento</td>
                    <td>{{ $dadosCotacao['metodoPagamento'] == 'boleto' ? 'Boleto' : 'Cartão de Crédito' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
