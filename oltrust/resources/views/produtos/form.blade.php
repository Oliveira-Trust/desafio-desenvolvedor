<div class="form-group {{ $errors->has('produto_nome') ? 'has-error' : ''}}">
    <label for="produto_nome" class="control-label">{{ 'Produto Nome' }}</label>
    <textarea class="form-control" rows="1" name="produto_nome" type="textarea" id="produto_nome" >{{ isset($produto->produto_nome) ? $produto->produto_nome : ''}}</textarea>
    {!! $errors->first('produto_nome', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('produto_val') ? 'has-error' : ''}}">
    <label for="produto_val" class="control-label">{{ 'Produto Val' }}</label>
    <input class="form-control" name="produto_val" type="date" id="produto_val" value="{{ isset($produto->produto_val) ? $produto->produto_val : ''}}" >
    {!! $errors->first('produto_val', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('produto_forn') ? 'has-error' : ''}}">
    <label for="produto_forn" class="control-label">{{ 'Produto Forn' }}</label>
    <textarea class="form-control" rows="1" name="produto_forn" type="textarea" id="produto_forn" >{{ isset($produto->produto_forn) ? $produto->produto_forn : ''}}</textarea>
    {!! $errors->first('produto_forn', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('produto_cont') ? 'has-error' : ''}}">
    <label for="produto_cont" class="control-label">{{ 'Produto Cont' }}</label>
    <textarea class="form-control" rows="1" name="produto_cont" type="textarea" id="produto_cont" >{{ isset($produto->produto_cont) ? $produto->produto_cont : ''}}</textarea>
    {!! $errors->first('produto_cont', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('produto_preco') ? 'has-error' : ''}}">
    <label for="produto_preco" class="control-label">{{ 'Produto Preco' }}</label>
    <input class="form-control" name="produto_preco" type="number" id="produto_preco" value="{{ isset($produto->produto_preco) ? $produto->produto_preco : ''}}" >
    {!! $errors->first('produto_preco', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
