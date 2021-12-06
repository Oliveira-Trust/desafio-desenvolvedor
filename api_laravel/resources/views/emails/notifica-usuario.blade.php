@component('mail::message')
# Cotação de Moedas Online

Olá {{ $nome }}, acompanhe sua nova cotação da moeda {{ $moeda }}.


Taxa de conversão: <b>R$ {{ number_format($taxaConversao, 2, ',', '.') }} </b><br>
Taxa de pagamento: <b>R$ {{ number_format($taxaPagamento, 2, ',', '.') }} </b><br>
Valor da moeda em BRL: <b> R$ {{ number_format($moedaDestino, 2, ',', '.') }} </b><br>
Moeda comprada: <b> {{ $moeda }} {{ number_format($moedaComprada, 2, ',', '.') }} </b><br>
Total conversão com descontos: <b> R$ {{ number_format($totalConversao, 2, ',', '.') }} </b><br>
Data da cotação: <b> {{ $dataCotacao }} </b><br>



Obrigado,<br>
{{ config('app.name') }}
@endcomponent
