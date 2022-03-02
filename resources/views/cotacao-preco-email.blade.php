<p>Dados Cotação</p>
<br>

<p>Moeda de origem: <b>{{ $cotacao_preco->origem_moeda }}</b></p>
<p>Moeda de destino: <b>{{ $cotacao_preco->destino_meda }}</b></p>
<p>Valor para conversão: <b>R$ {{ number_format($cotacao_preco->valor, 2, ',', '.') }}</b></p>
<p>Forma de pagamento: <b>{{ $cotacao_preco->MeioPagamento->meio_pagamento }}</b></p>
<p>Valor de "{{ $cotacao_preco->origem_moeda }}" usado para conversão: <b>{{ $cotacao_preco->destino_meda }} {{ number_format($cotacao_preco->valor_moeda, 2, ',', '.') }}</b></p>
<p>Valor comprado em "{{ $cotacao_preco->origem_moeda }}": <b>{{ $cotacao_preco->origem_moeda }} {{ number_format($cotacao_preco->preco_compra, 2, ',', '.') }}</b></p>
<p>Taxa de pagamento: <b>R$ {{ number_format($cotacao_preco->taxa_pagamento, 2, ',', '.') }}</b></p>
<p>Taxa de conversão: <b> {{ $cotacao_preco->taxa_conversao }}</b></p>
<p>Valor utilizado para conversão descontando as taxas: <b>R$ {{ number_format($cotacao_preco->valor - $cotacao_preco->taxa_pagamento - $cotacao_preco->taxa_conversao, 2, ',', '.') }}</b></p>