<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('coin_dest') }}
            {{ Form::text('coin_dest', $coin->coin_dest, ['class' => 'form-control' . ($errors->has('coin_dest') ? ' is-invalid' : ''), 'placeholder' => 'Coin Dest']) }}
            {!! $errors->first('coin_dest', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('coin_base') }}
            {{ Form::text('coin_base', $coin->coin_base, ['class' => 'form-control' . ($errors->has('coin_base') ? ' is-invalid' : ''), 'placeholder' => 'Coin Base']) }}
            {!! $errors->first('coin_base', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('label') }}
            {{ Form::text('label', $coin->label, ['class' => 'form-control' . ($errors->has('label') ? ' is-invalid' : ''), 'placeholder' => 'Label']) }}
            {!! $errors->first('label', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>