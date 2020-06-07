<div class="form-group {{ $errors->has('condicoes') ? 'has-error' : ''}}">
    <label for="condicoes" class="control-label">{{ 'Condicoes' }}</label>
    <input class="form-control" name="condicoes" type="text" id="condicoes" value="{{ isset($condico->condicoes) ? $condico->condicoes : ''}}" >
    {!! $errors->first('condicoes', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
