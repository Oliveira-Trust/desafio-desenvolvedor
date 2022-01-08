<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sua cotação</title>
</head>
<body>
    <h1>Resultado da sua cotação!</h1>
    
        <p>Moeda de origem: BRL</p>
        <p>Moeda de destino: {{$dados['moedaDestino']}}</p>     
        <p>Valor para conversão: {{$dados['valorParaConversao']}}</p>
        <p>Forma de pagamento: {{$dados['formaPg']}}</p>
        <p>Taxa de pagamento: {{$dados['taxaPg']}}</p> 
        <p>Taxa de conversão: {{$dados['taxaConversao']}}</p>  
        <p>Valor para conversão descontado as taxas: {{$dados['valorComDesconto']}}</p>
        <p>Valor da moeda de destino: {{$dados['valorMoeda']}}</p>  
        <p>Valor comprado em moeda de destino: {{$dados['valorConvertido']}}</p>
</body>
</html>

