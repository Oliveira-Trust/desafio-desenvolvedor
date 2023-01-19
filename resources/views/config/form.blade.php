<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('configure') }}
            {{ Form::text('configure', $config->configure, ['class' => 'form-control' . ($errors->has('configure') ? ' is-invalid' : ''), 'placeholder' => 'Configure','readonly' => 'readonly']) }}
            {!! $errors->first('configure', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $config->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description','readonly' => 'readonly']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('val') }}
            {{ Form::text('val', $config->val, ['class' => 'form-control' . ($errors->has('val') ? ' is-invalid' : ''), 'placeholder' => 'Val']) }}
            {!! $errors->first('val', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>