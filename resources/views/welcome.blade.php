<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio Laravel - Apresentação para Entrevista</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        .links {
            margin-top: 20px;
            text-align: center;
        }
        .links a {
            display: inline-block;
            margin: 0 10px;
            padding: 12px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        .links a:hover {
            background-color: #0056b3;
        }
        .rules {
            margin-top: 20px;
        }
        .rules ul {
            list-style-type: disc;
            padding-left: 20px;
        }
        .rules ul li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Desafio Laravel - Apresentação para Entrevista</h1>
        
        <div class="links">
            <a href="http://localhost:8025/" target="_blank">Mailpit</a>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Registro</a>
            <a href="http://localhost:8080/horizon/dashboard" target="_blank">Horizon</a>
            <a href="http://localhost:8080/api/documentation#/" target="_blank">Swagger</a>
            <a href="https://github.com/cassiuslc/desafio-desenvolvedor-Cassius-Leon" target="_blank">Git do Desafio</a>
        </div>

        <h2 style="margin-top: 20px;">Resumo do Desafio:</h2>
        <div class="rules">
            <p><strong>O Desafio:</strong><br>
            O usuário precisa informar 3 informações em tela, moeda de destino, valor para conversão e forma de pagamento. A nossa moeda nacional BRL será usada como moeda base na conversão.</p>

            <p><strong>As Regras de Negócio:</strong></p>
            <ul>
                <li>Moeda de origem BRL;</li>
                <li>Informar uma moeda de compra que não seja BRL (exibir no mínimo 2 opções);</li>
                <li>Valor da Compra em BRL (deve ser maior que R$ 1.000,00 e menor que R$ 100.000,00);</li>
                <li>Formas de pagamento (taxas aplicadas no valor da compra e aceitar apenas as opções abaixo):
                    <ul>
                        <li>Para pagamentos em boleto, taxa de 1,45%;</li>
                        <li>Para pagamentos em cartão de crédito, taxa de 7,63%;</li>
                    </ul>
                </li>
                <li>Aplicar taxa de 2% pela conversão para valores abaixo de R$ 3.000,00 e 1% para valores maiores que R$ 3.000,00, essa taxa deve ser aplicada apenas no valor da compra e não sobre o valor já com a taxa de forma de pagamento.</li>
            </ul>
        </div>
    </div>
</body>
</html>
