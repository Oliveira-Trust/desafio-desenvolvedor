

@component('mail::message')
# Cotação de Moedas

Moeda de origem: {{$moedaOrigem ?? ""}}<br>
Moeda de destino: {{$moedaDestino ?? ""}}<br>
Valor para conversão: {{  number_format($valorConversao, 2, ',', '.') ?? ""}}<br>
Forma de pagamento: {{$formaPgto == 'card' ? "Cartão de Crédito": $formaPgto}}<br>
Valor da "Moeda de destino" usado para conversão: $ {{ number_format($valorMoedaDestino, 2, ',', '.') ?? ""}}<br>
Valor comprado em "Moeda de destino": $ {{ number_format($valorComprado, 2, ',', '.') ?? ""}} (taxas aplicadas no valor de compra diminuindo no valor total de conversão)<br>
Taxa de pagamento: R$ {{ number_format($taxaPagamento, 2, ',', '.') ?? ""}}<br>
Taxa de conversão: R$ {{number_format($taxaConversao, 2, ',', '.')  ?? ""}}<br>
Valor utilizado para conversão descontando as taxas: R$ {{ number_format($valorTotalUsado, 2, ',', '.') ?? ""}}<br>


Muito Obrigado,<br>
{{ config('app.name') }}
@endcomponent
