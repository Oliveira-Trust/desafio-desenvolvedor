<div>
    Moeda de origem: {{ $conversion['currency'] }} <br>
    Moeda de destino: {{ $conversion['target_currency'] }} <br>
    Valor para conversão: {{ $conversion['amount'] }} <br>
    Forma de pagamento: {{ $conversion['paymentMethod']->name }} <br>
    Valor da "Moeda de destino" usado para conversão: {{ $conversion['bid'] }} <br>
    Taxa de pagamento: {{ $conversion['payment_fee'] }} <br>
    Taxa de conversão: {{ $conversion['amount_fee'] }} <br>
    Valor utilizado para conversão descontando as taxas: {{ $conversion['amount'] - $conversion['amount_fee'] - $conversion['payment_fee'] }} <br>
    <hr>
    <b>Valor comprado em "Moeda de destino":</b> {{ $conversion['target_amount'] }}
    <hr>
    <small>Cotação realizada em {{ $conversion['created_at'] }}</small>
</div>
