<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('coin_dest') }}
            {{ Form::text('coin_dest', $coinAsk->coin_dest, ['class' => 'form-control' . ($errors->has('coin_dest') ? ' is-invalid' : ''), 'placeholder' => 'Coin Dest']) }}
            {!! $errors->first('coin_dest', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('coin_base') }}
            {{ Form::text('coin_base', $coinAsk->coin_base, ['class' => 'form-control' . ($errors->has('coin_base') ? ' is-invalid' : ''), 'placeholder' => 'Coin Base']) }}
            {!! $errors->first('coin_base', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('value_of') }}
            {{ Form::text('value_of', $coinAsk->value_of, ['class' => 'form-control' . ($errors->has('value_of') ? ' is-invalid' : ''), 'placeholder' => 'Value Of']) }}
            {!! $errors->first('value_of', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('payment_method') }}
            {{ Form::text('payment_method', $coinAsk->payment_method, ['class' => 'form-control' . ($errors->has('payment_method') ? ' is-invalid' : ''), 'placeholder' => 'Payment Method']) }}
            {!! $errors->first('payment_method', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ranting_ask') }}
            {{ Form::text('ranting_ask', $coinAsk->ranting_ask, ['class' => 'form-control' . ($errors->has('ranting_ask') ? ' is-invalid' : ''), 'placeholder' => 'Ranting Ask']) }}
            {!! $errors->first('ranting_ask', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tax_convert') }}
            {{ Form::text('tax_convert', $coinAsk->tax_convert, ['class' => 'form-control' . ($errors->has('tax_convert') ? ' is-invalid' : ''), 'placeholder' => 'Tax Convert']) }}
            {!! $errors->first('tax_convert', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tax_payment') }}
            {{ Form::text('tax_payment', $coinAsk->tax_payment, ['class' => 'form-control' . ($errors->has('tax_payment') ? ' is-invalid' : ''), 'placeholder' => 'Tax Payment']) }}
            {!! $errors->first('tax_payment', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('total_used') }}
            {{ Form::text('total_used', $coinAsk->total_used, ['class' => 'form-control' . ($errors->has('total_used') ? ' is-invalid' : ''), 'placeholder' => 'Total Used']) }}
            {!! $errors->first('total_used', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('total_dest') }}
            {{ Form::text('total_dest', $coinAsk->total_dest, ['class' => 'form-control' . ($errors->has('total_dest') ? ' is-invalid' : ''), 'placeholder' => 'Total Dest']) }}
            {!! $errors->first('total_dest', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('user_id') }}
            {{ Form::text('user_id', $coinAsk->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>