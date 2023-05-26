<div class="col-sm-12">
    <h4>Formas de pagamento</h4>
</div>
    
<div class="col-sm-6">
    <input type="radio" id="credito" name="forma_pagamento" value="1">
    <label class="card" for="credito" id="campo_credito" style="display:block; border-radius: 5px; margin-bottom: 5px; box-shadow: none; padding: 5px; border: 1px #eee solid;">
        <h5 style="margin-bottom: 0px;">
            <i class="fad fa-credit-card" style="font-size: xxx-large;"></i>
            <span style="vertical-align: super;">Cartão de Crédito</span>
        </h5>
    </label>
</div>
<div class="col-sm-6">
    <input type="radio" id="boleto" name="forma_pagamento" value="2" >
    <label class="card"  for="boleto" id="campo_boleto" style="display:block; border-radius: 5px; margin-bottom: 5px; box-shadow: none; padding: 5px; border: 1px #eee solid;">
        <h5 style="margin-bottom: 0px;">
            <i class="fad fa-barcode-alt" style="font-size: xxx-large;"></i>
            <span style="vertical-align: super;">Boleto Bancário</span>
        </h5>
    </label>
</div>

<div class="col-sm-12">
    <button class="btn btn-block btn-danger" title="Converter" style="position: relative; width: 30%; left: 35%;" onclick="converter('#valor','#moeda', 'input[name = forma_pagamento]:checked','#token')">
        <i class="fad fa-exchange"></i> Converter
    </button>
</div> 