<div class="form-group {{ $errors->has('=nome_prod') ? 'has-error' : ''}}">
    <label for="=nome_prod" class="control-label">{{ '=nome Prod' }}</label>
    <textarea class="form-control" rows="5" name="=nome_prod" type="textarea" id="=nome_prod" >{{ isset($produto->=nome_prod) ? $produto->=nome_prod : ''}}</textarea>
    {!! $errors->first('=nome_prod', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('fab_prod') ? 'has-error' : ''}}">
    <label for="fab_prod" class="control-label">{{ 'Fab Prod' }}</label>
    <input class="form-control" name="fab_prod" type="date" id="fab_prod" value="{{ isset($produto->fab_prod) ? $produto->fab_prod : ''}}" >
    {!! $errors->first('fab_prod', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('forn_nome') ? 'has-error' : ''}}">
    <label for="forn_nome" class="control-label">{{ 'Forn Nome' }}</label>
    <textarea class="form-control" rows="5" name="forn_nome" type="textarea" id="forn_nome" >{{ isset($produto->forn_nome) ? $produto->forn_nome : ''}}</textarea>
    {!! $errors->first('forn_nome', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('forn_contato') ? 'has-error' : ''}}">
    <label for="forn_contato" class="control-label">{{ 'Forn Contato' }}</label>
    <textarea class="form-control" rows="5" name="forn_contato" type="textarea" id="forn_contato" >{{ isset($produto->forn_contato) ? $produto->forn_contato : ''}}</textarea>
    {!! $errors->first('forn_contato', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
