@component('mail::message')

<h1>Olá, {{$data->user()->name}}, recebeu uma mensagem da FINTOOLS sobre o envio da cotação do dinheiro.</h1>

<p>Aquí estão os dados da conversão feita: </p>


<ul>

<li>Moeda de origem: {{$data->moeda_origem}}</li>
<li>Moeda de destino: {{$data->moeda_destino}}</li>
<li>Valor para conversão: {{$data->valor_conversao}}</li>
<li>Forma de pagamento: {{$data->forma_pagamento}}</li>
<li>Valor da "Moeda de destino" usado para conversão: {{ round($data->valor_usado_conversao,2)}}</li>
<li>Valor comprado em "Moeda de destino": {{ round($data->valor_comprado,2) }}</li>
<li>Taxa de pagamento: {{$data->taxa_pagamento}}</li>
<li>Taxa de conversão: {{$data->taxa_conversao}}</li>
<li>Valor utilizado para conversão descontando as taxas: {{$data->valor_conversao_com_taxas}}</li>

</ul>

@endcomponent

