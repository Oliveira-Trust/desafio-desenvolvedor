<div class="form-group {{ $errors->has('pedido_ident') ? 'has-error' : ''}}">
    <label for="pedido_ident" class="control-label">{{ 'Pedido Ident' }}</label>
    <input class="form-control" name="pedido_ident" type="number" id="pedido_ident" value="{{ isset($pedido->pedido_ident) ? $pedido->pedido_ident : ''}}" >
    {!! $errors->first('pedido_ident', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('pedido_data') ? 'has-error' : ''}}">
    <label for="pedido_data" class="control-label">{{ 'Pedido Data' }}</label>
    <input class="form-control" name="pedido_data" type="date" id="pedido_data" value="{{ isset($pedido->pedido_data) ? $pedido->pedido_data : ''}}" >
    {!! $errors->first('pedido_data', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('cliente_id') ? 'has-error' : ''}}">
    <label for="cliente_id" class="control-label">{{ 'Cliente Id' }}</label>
    <input class="form-control" name="cliente_id" type="number" id="cliente_id" value="{{ isset($pedido->cliente_id) ? $pedido->cliente_id : ''}}" >
    {!! $errors->first('cliente_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('produto_id') ? 'has-error' : ''}}">
    <label for="produto_id" class="control-label">{{ 'Produto Id' }}</label>
    <input class="form-control" name="produto_id" type="number" id="produto_id" value="{{ isset($pedido->produto_id) ? $pedido->produto_id : ''}}" >
    {!! $errors->first('produto_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('pedido_status') ? 'has-error' : ''}}">
    <label for="pedido_status" class="control-label">{{ 'Pedido Status' }}</label>
    <select name="pedido_status" class="form-control" id="pedido_status" >
    @foreach (json_decode('{aberto: Aberto, aguardando: Aguardando, finalizado: Finalizado}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($pedido->pedido_status) && $pedido->pedido_status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('pedido_status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
