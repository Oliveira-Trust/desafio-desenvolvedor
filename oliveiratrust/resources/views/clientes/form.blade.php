<div class="form-group {{ $errors->has('=nome_cli') ? 'has-error' : ''}}">
    <label for="=nome_cli" class="control-label">{{ '=nome Cli' }}</label>
    <textarea class="form-control" rows="5" name="=nome_cli" type="textarea" id="=nome_cli" >{{ isset($cliente->=nome_cli) ? $cliente->=nome_cli : ''}}</textarea>
    {!! $errors->first('=nome_cli', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email_cli') ? 'has-error' : ''}}">
    <label for="email_cli" class="control-label">{{ 'Email Cli' }}</label>
    <textarea class="form-control" rows="5" name="email_cli" type="textarea" id="email_cli" >{{ isset($cliente->email_cli) ? $cliente->email_cli : ''}}</textarea>
    {!! $errors->first('email_cli', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('tel_cli') ? 'has-error' : ''}}">
    <label for="tel_cli" class="control-label">{{ 'Tel Cli' }}</label>
    <textarea class="form-control" rows="5" name="tel_cli" type="textarea" id="tel_cli" >{{ isset($cliente->tel_cli) ? $cliente->tel_cli : ''}}</textarea>
    {!! $errors->first('tel_cli', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('aniv_cli') ? 'has-error' : ''}}">
    <label for="aniv_cli" class="control-label">{{ 'Aniv Cli' }}</label>
    <input class="form-control" name="aniv_cli" type="date" id="aniv_cli" value="{{ isset($cliente->aniv_cli) ? $cliente->aniv_cli : ''}}" >
    {!! $errors->first('aniv_cli', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
