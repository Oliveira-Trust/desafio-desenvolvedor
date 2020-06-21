<form id="status-create">
    @csrf
    <input id="type-request" type="hidden" name="uuid" value="new">
    <input id="uuid" type="hidden" name="uuid" value="">
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('status.columns.name') }}</label>

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
        <label for="ref_table"
            class="col-md-4 col-form-label text-md-right">{{ __('status.columns.ref_table_input') }}</label>

        <div class="col-md-6">
            <select id="ref_table" class="form-control @error('ref_table') is-invalid @enderror" name="ref_table">
                @foreach($ref_tables as $value => $name)
                <option value="{{ $value }}">{{ $name }}</option>
                @endforeach
            </select>

            @error('ref_table')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="enable"
            class="col-md-4 col-form-label text-md-right">{{ __('status.columns.enable') }}</label>
        <div class="col-md-6">
            <select id="enable" class="form-control @error('enable') is-invalid @enderror" name="enable">
                <option value="1">{{ __("Enable") }}</option>
                <option value="0">{{ __("Disable") }}</option>
            </select>

            @error('enable')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="status"
            class="col-md-4 col-form-label text-md-right">{{ __('status.columns.status_input') }}</label>
        <div class="col-md-6">
            <select id="status" class="form-control @error('status') is-invalid @enderror" name="status">
                <option value="1">{{ __("Active") }}</option>
                <option value="0">{{ __("Inactive") }}</option>
            </select>

            @error('status')
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