<div class="row">
    <div class="col-md-12">
        <p style="font-weight: bold;">{{ __("Registered by") }} <span
                style="font-style: italic;">{{ $client->user->name }}</span></p>
    </div>
    <div class="col-md-6 col-sm-12">
        <!-- Name Field -->
        <div class="form-group">
            {!! Form::label('name', __("client.columns.name") . ':') !!}
            <p>{{ $client->name }}</p>
        </div>

        <!-- Dob Field -->
        <div class="form-group">
            {!! Form::label('dob', __("client.columns.dob") . ':') !!}
            <p>{{ $client->dob->format('d/m/Y') }}</p>
        </div>

        <!-- Email Field -->
        <div class="form-group">
            {!! Form::label('email', __("client.columns.email") . ':') !!}
            <p><a href="mailto:{{ $client->email }}" target="_blank">{{ $client->email }}</a></p>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <!-- Address Field -->
        <div class="form-group">
            {!! Form::label('address', __("client.columns.address") . ':') !!}
            <p>{{ $client->address }}</p>
        </div>

        <!-- Contact Field -->
        <div class="form-group">
            {!! Form::label('contact', __("client.columns.contact") . ':') !!}
            <p>{{ $client->contact }}</p>
        </div>

        <!-- Status Id Field -->
        <div class="form-group">
            {!! Form::label('status_id', __("client.columns.status_id") . ':') !!}
            <p>{{ $client->status->name }}</p>
        </div>
    </div>
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        <br />
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">{{ __("Back") }}</a>
    </div>
</div>