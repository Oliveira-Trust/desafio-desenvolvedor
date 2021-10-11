@component('mail::message')
# Olá, {{ $data['user_name'] }}!

Dados da sua cotação:

- Moeda de origem: {{$data['from_currency']}}
- Moeda de destino: {{$data['to_currency']}}
- Valor para conversão: R$ {{ $data['amount'] }}
- Forma de pagamento: {{$data['payment_method']}}
- Taxa de pagamento: R$ {{ $data['payment_fee'] }}
- Taxa de conversão: R$ {{ $data['conversion_fee'] }}
- Valor utilizado para conversão descontando as taxas*: R$ {{ $data['new_amount'] }}
- Valor da cotação usado para conversão: R$ {{ $data['quotation'] }}
- Valor final em <b> {{$data['to_currency']}}: {{ $data['amount_converted'] }} </b>

* Taxas aplicadas no valor de compra diminuindo no valor total de conversão.

Obrigado pela preferência.  
{{ config('app.name') }}
@endcomponent
