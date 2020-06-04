<div class="form-group {{ $errors->has('=data_ped') ? 'has-error' : ''}}">
    <label for="=data_ped" class="control-label">{{ '=data Ped' }}</label>
    <input class="form-control" name="=data_ped" type="date" id="=data_ped" value="{{ isset($pedido->=data_ped) ? $pedido->=data_ped : ''}}" >
    {!! $errors->first('=data_ped', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('cli_id') ? 'has-error' : ''}}">
    <label for="cli_id" class="control-label">{{ 'Cli Id' }}</label>
    <input class="form-control" name="cli_id" type="number" id="cli_id" value="{{ isset($pedido->cli_id) ? $pedido->cli_id : ''}}" >
    {!! $errors->first('cli_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('prod_id') ? 'has-error' : ''}}">
    <label for="prod_id" class="control-label">{{ 'Prod Id' }}</label>
    <input class="form-control" name="prod_id" type="number" id="prod_id" value="{{ isset($pedido->prod_id) ? $pedido->prod_id : ''}}" >
    {!! $errors->first('prod_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
