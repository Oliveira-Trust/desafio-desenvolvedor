<p>Moeda de origem: <b>{{ $price_quote->from_currency }}</b></p>
<p>Moeda de destino: <b>{{ $price_quote->to_currency }}</b></p>
<p>Valor para conversão: <b>R$ @convert($price_quote->value)</b></p>
<p>Forma de pagamento: <b>{{ $price_quote->paymentMethod->method_name }}</b></p>
<p>Valor de "{{ $price_quote->to_currency }}" usado para conversão: <b>{{ $price_quote->currency_symbol }} @convert($price_quote->currency_value)</b></p>
<p>Valor comprado em "{{ $price_quote->to_currency }}": <b>{{ $price_quote->currency_symbol }} @convert($price_quote->purchase_price)</b></p>
<p>Taxa de pagamento: <b>R$ @convert($price_quote->payment_rate)</b></p>
<p>Taxa de conversão: <b>R$ @convert($price_quote->conversion_rate)</b></p>
<p>Valor utilizado para conversão descontando as taxas: <b>R$ @convert($price_quote->discounted_value)</b></p>