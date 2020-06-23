<form id="order-create">
    @csrf
    <input id="type-request" type="hidden" name="uuid" value="new">
    <input id="uuid" type="hidden" name="uuid" value="">
    <input id="user_id" type="hidden" name="user_id" value="{{ session('userData.uuid') }}">

    <div class="form-group row">
        <label for="client_id"
            class="col-md-4 col-form-label text-md-right">{{ __('order.columns.client_id') }}</label>

        <div class="col-md-6">
            <select id="client_id" class="form-control @error('client_id') is-invalid @enderror" name="client_id">
                @foreach($clients as $client)
                <option value="{{ $client['uuid'] }}">{{ $client['name'] }}</option>
                @endforeach
            </select>

            @error('client_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="status_id"
            class="col-md-4 col-form-label text-md-right">{{ __('order.columns.status_id') }}</label>

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
    <div class="form-group row">
        <label for="products" class="col-md-4 col-form-label text-md-right">{{ __('order.columns.products') }}</label>
    
        <div class="col-md-2">
        <input id="products-qnt" class="form-control" type="number" min="1" value="1" placeholder="{{ __("Qnt") }}">
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <select id="products" class="form-control @error('products') is-invalid @enderror">
                    @foreach($products as $product)
                    <option data-img="{{ $product['image'] }}" data-price="{{ $product['price'] }}" value="{{ $product['uuid'] }}">{{ $product['name'] }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <a href="javascript:void(0);" class="btn btn-outline-info" onclick="addProduct()">{{ __("Add") }}</a>
                </div>
            </div>
    
            @error('products')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <ul id="products-list" class="list-group">
            </ul>
        </div>
    </div>
    <br />

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <span onclick="saveItem();" class="btn btn-primary">
                {{ __('Save') }}
            </span>
        </div>
    </div>
</form>