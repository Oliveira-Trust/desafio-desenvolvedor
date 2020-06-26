<div class="row">
    <div class="col-md-6 col-sm-12">
        <!-- Name Field -->
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            <p>{{ $status->name }}</p>
        </div>

        <!-- Reference Field -->
        <div class="form-group">
            {!! Form::label('ref_table', 'Reference:') !!}
            <p>{{ $status::getRefTables()[$status->ref_table] }}</p>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <!-- Enable Field -->
        <div class="form-group">
            {!! Form::label('enable', 'Enable:', ['class' => 'label']) !!}
            <p>{{ $status::getEnableLabel()[$status->enable] }}</p>
        </div>

        <!-- Status Field -->
        <div class="form-group">
            {!! Form::label('status', 'Status:') !!}
            <p>{{ $status::getStatusLabel()[$status->status] }}</p>
        </div>
    </div>
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        <br />
        <a href="{{ route('statuses.index') }}" class="btn btn-secondary">{{ __("Back") }}</a>
    </div>
</div>