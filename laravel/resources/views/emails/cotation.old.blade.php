<!DOCTYPE html>
<html>
<head>
    <title>ItsolutionStuff.com</title>
</head>
<body>
<h1>Olá, {{ $data['name'] }}!</h1>
<p>Segue os dados da sua cotação</p>

<div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Moeda de origem:
            <strong>{{$data['currency_origin']}}</strong></li>
        <li class="list-group-item">Moeda de destino:
            <strong>{{$data['currency_buy']}}</strong></li>
        <li class="list-group-item">Valor para Conversão:
            <strong>@money($data['amount'])</strong></li>
        <li class="list-group-item">Forma de pagamento:
            <strong>{{$data['payment_type']}}</strong></li>
        <li class="list-group-item">Valor da "Moeda de destino" usado para conversão:
            <strong>@money($data['currency_value'])</strong>
        </li>
        <li class="list-group-item">Valor comprado em "Moeda de destino":
            <strong>@money($data['value_bought'])</strong>
        </li>
        <li class="list-group-item">Taxa de pagamento: <strong>@money($data['payment_tax'])</strong>
        </li>
        <li class="list-group-item">Taxa de conversão: <strong>
                @money($data['conversion_tax'])</strong>
        </li>
        <li class="list-group-item">Valor utilizado para conversão descontando as taxas:
            <strong>@money($data['conversion_value'])</strong>
        </li>

    </ul>
</div>

</body>
</html>
