@component('mail::message')
# Conversão de Valores

Olá {{ $nome }}, tudo bem?

Veja agora sua nova cotação da moeda {{ $moedaDestino }}.


Valor de conversão: <b>R$ {{ number_format($valorConversao, 2, ',', '.') }} </b><br>
Taxa de conversão: <b>R$ {{ number_format($taxaConversao, 2, ',', '.') }} </b><br>
Taxa de pagamento: <b>R$ {{ number_format($taxaPagamento, 2, ',', '.') }} </b><br>
Valor da moeda BRL: <b> R$ {{ number_format($valorMoedaDestino, 2, ',', '.') }} </b><br>
Valor comprado: <b> {{ $moedaDestino }} {{ number_format($valorComprado, 2, ',', '.') }} </b><br>
Total com descontos: <b> R$ {{ number_format($totalDescontato, 2, ',', '.') }} </b><br>
Data da cotação: <b> {{ $dataCotacao }} </b><br>



Nosso Muito Obrigado,<br>

{{ config('app.name') }}
@endcomponent
