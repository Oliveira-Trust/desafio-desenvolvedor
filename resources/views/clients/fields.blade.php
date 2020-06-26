<div class="row">
    <div class="col-md-6 col-sm-12">
        @if (empty($client))
        {!! Form::hidden('user_id', \Auth::user()->id) !!}
        @else
        {!! Form::hidden('user_id', $client->user_id) !!}
        @endif
        <!-- Name Field -->
        <div class="form-group">
            {!! Form::label('name', __("client.columns.name") . ':') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Dob Field -->
        <div class="form-group">
            {!! Form::label('dob', __("client.columns.dob") . ':') !!}
            {!! Form::date('dob', (empty($client) ? null : $client->dob->format('Y-m-d')), ['class' => 'form-control', 'id'=>'dob']) !!}
        </div>

        @push('scripts')
            <script type="text/javascript">
            var maskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            options = {
            onKeyPress: function (val, e, field, options) {
            field.mask(maskBehavior.apply({}, arguments), options);
            }
            };
            
            $('#contact').mask(maskBehavior, options);
            </script>
        @endpush

        <!-- Email Field -->
        <div class="form-group">
            {!! Form::label('email', __("client.columns.email") . ':') !!}
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <!-- Address Field -->
        <div class="form-group">
            {!! Form::label('address', __("client.columns.address") . ':') !!}
            {!! Form::text('address', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Contact Field -->
        <div class="form-group">
            {!! Form::label('contact', __("client.columns.contact") . ':') !!}
            {!! Form::text('contact', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Status Id Field -->
        <div class="form-group">
            {!! Form::label('status_id', __("client.columns.status_id") . ':') !!}
            {!! Form::select('status_id', $statuses, null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit(__("Save"), ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">{{ __("Cancel")}}</a>
    </div>
</div>

