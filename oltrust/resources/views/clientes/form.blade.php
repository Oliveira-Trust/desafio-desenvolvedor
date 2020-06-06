<div class="form-group {{ $errors->has('cliente_nome') ? 'has-error' : ''}}">
    <label for="cliente_nome" class="control-label">{{ 'Cliente Nome' }}</label>
    <textarea class="form-control" rows="5" name="cliente_nome" type="textarea" id="cliente_nome" >{{ isset($cliente->cliente_nome) ? $cliente->cliente_nome : ''}}</textarea>
    {!! $errors->first('cliente_nome', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('cliente_email') ? 'has-error' : ''}}">
    <label for="cliente_email" class="control-label">{{ 'Cliente Email' }}</label>
    <textarea class="form-control" rows="5" name="cliente_email" type="textarea" id="cliente_email" >{{ isset($cliente->cliente_email) ? $cliente->cliente_email : ''}}</textarea>
    {!! $errors->first('cliente_email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('cliente_tel') ? 'has-error' : ''}}">
    <label for="cliente_tel" class="control-label">{{ 'Cliente Tel' }}</label>
    <textarea class="form-control" rows="5" name="cliente_tel" type="textarea" id="cliente_tel" >{{ isset($cliente->cliente_tel) ? $cliente->cliente_tel : ''}}</textarea>
    {!! $errors->first('cliente_tel', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('cliente_aniv') ? 'has-error' : ''}}">
    <label for="cliente_aniv" class="control-label">{{ 'Cliente Aniv' }}</label>
    <input class="form-control" name="cliente_aniv" type="date" id="cliente_aniv" value="{{ isset($cliente->cliente_aniv) ? $cliente->cliente_aniv : ''}}" >
    {!! $errors->first('cliente_aniv', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
