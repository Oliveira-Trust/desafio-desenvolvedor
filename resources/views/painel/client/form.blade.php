<form id="client-create">
    @csrf
    <input id="type-request" type="hidden" name="uuid" value="new">
    <input id="uuid" type="hidden" name="uuid" value="">
    <input id="user_id" type="hidden" name="user_id" value="{{ session('userData.uuid') }}">
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('client.columns.name') }}</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('client.columns.dob') }}</label>

        <div class="col-md-6">
            <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob"
                value="{{ old('dob') }}" required>

            @error('dob')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('client.columns.email') }}</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('client.columns.address') }}</label>

        <div class="col-md-6">
            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                value="{{ old('address') }}" required>

            @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('client.columns.contact') }}</label>

        <div class="col-md-6">
            <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" name="contact"
                value="{{ old('contact') }}" required>

            @error('contact')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="status_id"
            class="col-md-4 col-form-label text-md-right">{{ __('client.columns.status_id') }}</label>

        <div class="col-md-6">
            <select id="status_id" class="form-control @error('status_id') is-invalid @enderror" name="status_id">
                @foreach($statuses as $status)
                <option value="{{ $status['uuid'] }}">{{ $status['name'] }}</option>
                @endforeach
            </select>

            @error('status_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <span onclick="saveItem();" class="btn btn-primary">
                {{ __('Save') }}
            </span>
        </div>
    </div>
</form>