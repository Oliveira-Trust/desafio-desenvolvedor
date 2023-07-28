
<!-- resources/views/email.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Cotação Realizada</title>
</head>
<body>
    <h2>Olá {{ $name }},</h2>
    <p>
        Sua cotação de conversão de moeda foi realizada com sucesso. Aqui estão os detalhes:
    </p>
    <p>Moeda de origem: {{ $from_currency }}</p>
    <p>Moeda de destino: {{ $to_currency }}</p>
    <p>Valor convertido: {{ $amount }}</p>
    <p>Valor final (após taxas): {{ $converted_amount }}</p>
    <p>Taxa de pagamento: {{ $payment_fee }}</p>
    <p>Taxa de conversão: {{ $conversion_fee }}</p>
    <p>Método de pagamento: {{ $payment_method }}</p>

    <p>
        Obrigado,
        <br/>
        <br/>
        Sua equipe.
    </p>
</body>
</html>
