<p>Prezado {{ $data['contact']['mail'] }}<p>
<p>Segue sua cotação</p><br>
<strong>Moeda de origem: </strong><span>Real brasileiro</span><br>
<strong>Moeda de destino: </strong><span>{{ $data['contact']['moedaDestino'] }}</span><br>
<strong>Valor para conversão: </strong><span>{{ $data['contact']['valor'] }}</span><br>
<strong>Forma pagamento: </strong><span>{{ $data['contact']['formaPagto'] }}</span><br>
<strong>Valor da cotação: </strong><span>{{ $data['contact']['valorMoedaDestino'] }}</span><br>
<strong>Valor comprado: </strong><span>{{ $data['contact']['valorComprado'] }}</span><br>
<strong>Taxa de pagamento: </strong><span>{{ $data['contact']['taxaPagto'] }}</span><br>
<strong>Taxa de conversão: </strong><span>{{ $data['contact']['taxConversion'] }}</span><br>
<strong>Valor utilizado para conversão descontando as taxas: </strong><span>{{ $data['contact']['valorTotalDescontado'] }}</span>
