<b>Moeda de origem: </b> {{ $conversion->currency_origin_name }} <br>
<b>Moeda de destino: </b> {{ $conversion->currency_destiny_name }} <br>
<b>Valor para conversão: </b> {{ fm($conversion->currency_origin_value,currency: $conversion->currency_origin_symbol) }} <br>
<b>Forma de pagamento: </b> {{ $conversion->payment_type }} <br>
<b>Valor da "Moeda de destino" usado para conversão: </b> {{ fm($conversion->currency_destiny_conversion, currency: $conversion->currency_destiny_symbol) }} <br>
<b>Valor comprado em "Moeda de destino": </b> {{ fm($conversion->currency_destiny_value,currency:  $conversion->currency_destiny_symbol) }} (taxas aplicadas no valor de compra diminuindo no valor total de conversão)<br>
<b>Taxa de pagamento: </b> {{ fm($conversion->payment_tax, currency: $conversion->currency_origin_symbol) }} <br>
<b>Taxa de conversão: </b> {{ fm($conversion->conversion_tax, currency: $conversion->currency_origin_symbol) }} <br>
<b>Valor utilizado para conversão descontando as taxas: </b> {{ fm($conversion->currency_origin_value_with_tax, currency: $conversion->currency_origin_symbol) }} <br>
