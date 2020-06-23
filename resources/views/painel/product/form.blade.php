<form id="product-create">
    @csrf
    <input id="type-request" type="hidden" name="uuid" value="new">
    <input id="uuid" type="hidden" name="uuid" value="">
    <input id="user_id" type="hidden" name="user_id" value="{{ session('userData.uuid') }}">
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('product.columns.name') }}</label>

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
        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('product.columns.description') }}</label>

        <div class="col-md-6">
            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required>{{ old('description') }}</textarea>

            @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('product.columns.price') }}</label>

        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">{{ __("Currency Symbol") }}</span>
                </div>
                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required>
            </div>

            @error('price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('product.columns.image') }}</label>

        <div class="col-md-6">
            <select id="image" class="form-control @error('image') is-invalid @enderror" name="image" required>
                @foreach($images as $path => $image)
                <option value="{{ $path }}">{{ $image }}</option>
                @endforeach
            </select>

            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="status_id"
            class="col-md-4 col-form-label text-md-right">{{ __('product.columns.status_id') }}</label>

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