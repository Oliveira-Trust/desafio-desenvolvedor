<!DOCTYPE html>
<html>

<head>
    <title>CurrencyConvert</title>
</head>

<body>
    <h1>Olá, {{ $mailData['name'] }}</h1>
    <p>Abaixo segue a sua cotação</p>

    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <td><strong>Moeda de Origem</strong></td>
                <td>{{ $mailData['cotation']->origin_currency }}</td>
            </tr>
            <tr>
                <td><strong>Moeda de Destino</strong></td>
                <td>{{ $mailData['cotation']->destination_currency }}</td>
            </tr>
            <tr>
                <td><strong>Valor para Conversão</strong></td>
                <td>{{ $mailData['cotation']->conversion_amount }}</td>
            </tr>
            <tr>
                <td><strong>Forma de Pagamento</strong></td>
                <td><td>{{ ( $mailData['cotation']->payment_method == "ticket" ) ? "Boleto" : "Cartão de Crédito"  }}</td></td>
            </tr>
            <tr>
                <td><strong>Valor do {{ $mailData['cotation']->destination_currency }}</span></strong></td>
                <td>{{ $mailData['cotation']['currency_rate'] }}</td>
            </tr>
            <tr>
                <td><strong>Valor comprado em {{ $mailData['cotation']->destination_currency }}</span></strong></td>
                <td>{{ $mailData['cotation']['purchase_amount'] }}</td>
            </tr>
            <tr>
                <td><strong>Taxa de pagamento</strong></td>
                <td>{{ $mailData['cotation']->payment_fee }}</td>
            </tr>
            <tr>
                <td><strong>Taxa de conversão</strong></td>
                <td>{{ $mailData['cotation']->conversion_fee }}</td>
            </tr>
            <tr>
                <td><strong>Valor da Conversão - Taxas</strong></td>
                <td>{{ $mailData['cotation']->amount_minus_fee }}</td>
            </tr>
            <tr>
                <td><strong>Data da Conversão</strong></td>
                <td>{{ $mailData['cotation']->created_at }}</td>
            </tr>
        </tbody>
    </table>

    <p>Obrigado</p>
</body>

</html>