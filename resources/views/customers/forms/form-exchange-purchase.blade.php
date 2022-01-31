<div class="form-group">
    <label class="label" for="purchase">Valor da compra</label>
    <input type='number' name='calc[purchase_value]' id="purchase" placeholder="Valor da compra"
           class="form-control"
           step=".01"
           value="{{old('calc.purchase_value') ?? "5000.00"}}"
           required/>
</div>
<h5>Moedas</h5>
<div class="form-group">
    <label class="label" for="to">Converter de</label>
    <select name='calc[to]' id="to" class="form-control" style="width: 100%">
        <option value="0">Selecione a moeda da compra</option>
        @foreach($currenciesFrom as $currency)
            <option
                value="{{$currency->code}}" {{$currency->code === 'BRL' ? 'selected':''}} >{{"{$currency->code} - {$currency->name}"}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label class="label" for="from">Converter para</label>
    <select name='calc[from]' id="from" class="form-control" style="width: 100%">
        <option value="0">Selecione a moeda da conversão</option>
        @foreach($currenciesTo as $currency)
            <option value="{{$currency->code}}"  {{$currency->code === 'USD' ? 'selected':''}}>{{"{$currency->code} - {$currency->name}"}}</option>
        @endforeach
    </select>

</div>

<div class="form-group mx-1">
    <button type="button" onclick="calculate()" class="btn btn-primary">Consultar</button>
    <button type="button" onclick="cleanSearch()" class="btn btn-warning">Limpar</button>
</div>
