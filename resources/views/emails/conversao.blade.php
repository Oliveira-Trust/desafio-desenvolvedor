@component('mail::message')
# Conversão Realizada

Segue os detalhes da conversão.

<p><strong>Moeda de origem:</strong> {{$conversao->moeda_origem}} </p>
<p><strong>Moeda de destino:</strong> {{$conversao->moeda_destino}} </p>
<p><strong>Valor para conversão:</strong> {{ number_format($conversao->valor_solicitado,2,',','.') }} </p>
<p><strong>Forma de pagamento:</strong> {{$conversao->forma_pagamento}} </p>
<p><strong>Valor da "Moeda de destino" usado para conversão:</strong> {{ number_format($conversao->cotacao_moeda_destino,2,',','.') }} </p>
<p><strong>Valor comprado em "Moeda de destino":</strong> {{ number_format($conversao->valor_convertido,2,',','.') }} </p>
<p><strong>Taxa de pagamento:</strong> {{ number_format($conversao->taxa_pagamento,2,',','.') }} </p>
<p><strong>Taxa de conversão:</strong> {{ number_format($conversao->taxa_conversao,2,',','.') }} </p>
<p><strong>Valor utilizado para conversão descontando as taxas:</strong> {{ number_format(($conversao->valor_solicitado-$conversao->taxa_pagamento-$conversao->taxa_conversao),2,',','.') }} </p>


Obrigado,<br>
{{ config('app.name') }}
@endcomponent
