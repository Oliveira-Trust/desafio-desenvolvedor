<div class="row">
    <div class="col-md-6 col-sm-12">
        <!-- Name Field -->
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Reference Field -->
        <div class="form-group">
            {!! Form::label('ref_table', 'Reference:') !!}
            {!! Form::select('ref_table', $ref_tables, null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <!-- Enable Field -->
        <div class="form-group">
            {!! Form::label('enable', 'Enable:') !!}
            {!! Form::select('enable', [__("Disable"), __("Enable")], null, ['class' => 'form-control']) !!}
        </div>

        <!-- Status Field -->
        <div class="form-group">
            {!! Form::label('status', 'Status:') !!}
            {!! Form::select('status', $statuses, null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit(__("Save"), ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('statuses.index') }}" class="btn btn-secondary">{{__("Cancel")}}</a>
    </div>
</div>