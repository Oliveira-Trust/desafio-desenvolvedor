@component('mail::message')



Olá, {{$name}}, segue abaixo os dados de sua última cotação em nosso portal. 

> Moeda de origem: BRL
> Moeda de destino: {{$quotation['source_coin']}}
> Valor para conversão: R$ {{$quotation['conversion_amount']}}
> Forma de pagamento: {{$quotation['payment_type']}}
> Valor da "Moeda de destino" usado para conversão: $ {{$quotation['source_coin_value']}}
> Valor comprado em "Moeda de destino": $ {{$quotation['buy_amount']}} (taxas aplicadas no valor de compra diminuindo no valor total de conversão)
> Taxa de pagamento: R$ {{$quotation['rate_payment']}}
> Taxa de conversão: R$ {{$quotation['conversion_rate']}}
> Valor utilizado para conversão descontando as taxas: R$ {{$quotation['net_amount']}}


Obrigado,<br>
{{ config('app.name') }}
@endcomponent