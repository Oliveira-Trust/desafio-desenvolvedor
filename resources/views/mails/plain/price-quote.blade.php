Moeda de origem: {{ $price_quote->from_currency }}
Moeda de destino: {{ $price_quote->to_currency }}
Valor para conversão: R$ @convert($price_quote->value)
Forma de pagamento: {{ $price_quote->paymentMethod->method_name }}
Valor de "{{ $price_quote->to_currency }}" usado para conversão: {{ $price_quote->currency_symbol }} @convert($price_quote->currency_value)
Valor comprado em "{{ $price_quote->to_currency }}": {{ $price_quote->currency_symbol }} @convert($price_quote->purchase_price)
Taxa de pagamento: R$ @convert($price_quote->payment_rate)
Taxa de conversão: R$ @convert($price_quote->conversion_rate)
Valor utilizado para conversão descontando as taxas: R$ @convert($price_quote->discounted_value)