<div class="row">
    <div class="col-md-6 col-sm-12">
        <!-- Name Field -->
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Ref Table Field -->
        <div class="form-group">
            {!! Form::label('ref_table', 'Ref Table:') !!}
            <select id="ref_table" class="form-control @error('ref_table') is-invalid @enderror" name="ref_table">
                @foreach($ref_tables as $value => $name)
                <option value="{{ $value }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <!-- Enable Field -->
        <div class="form-group">
            {!! Form::label('enable', 'Enable:') !!}
            <select id="enable" class="form-control @error('enable') is-invalid @enderror" name="enable">
                <option value="1">{{ __("Enable") }}</option>
                <option value="0">{{ __("Disable") }}</option>
            </select>
        </div>


        <!-- Status Field -->
        <div class="form-group">
            {!! Form::label('status', 'Status:') !!}
            <select id="status" class="form-control @error('status') is-invalid @enderror" name="status">
                @foreach($statuses as $value => $name)
                <option value="{{ $value }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('statuses.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</div>