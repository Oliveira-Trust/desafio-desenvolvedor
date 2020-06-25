<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $status->name }}</p>
</div>

<!-- Ref Table Field -->
<div class="form-group">
    {!! Form::label('ref_table', 'Ref Table:') !!}
    <p>{{ $status->ref_table }}</p>
</div>

<!-- Enable Field -->
<div class="form-group">
    {!! Form::label('enable', 'Enable:') !!}
    <p>{{ $status->enable }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $status->status }}</p>
</div>

