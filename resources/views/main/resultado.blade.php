<div class="col-sm-12">
    <h4>Resultado da conversão</h4>
</div>
<div class="col-sm-6">
    <div class="card" style="display:block; border-radius: 5px; margin-bottom: 5px; box-shadow: none; border: 1px #eee solid;">
        <b>Conversão de:</b> {{$nomeCode}}<br>
        <b>Valor a converter:</b> {{$valor}} - taxa conversão {{$taxa_conversao}}%<br>
        <b>Método de Pagamento:</b> {{$pagamento}} - taxa de {{$taxa_pagamento}}%
    </div>
</div>
<div class="col-sm-6">
    <div class="card" style="display:block; border-radius: 5px; margin-bottom: 5px; box-shadow: none; border: 1px #eee solid;">
        <b>Para:</b> {{$nomeCodeIn}}<br>
        <b>Cotação em {{$data_cotacao}}:</b> {{$cotacao}}<br>
        <b>Resultado da conversão:</b> {{$convertido}}<br>
    </div>
</div>