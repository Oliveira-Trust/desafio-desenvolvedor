<div class="row">
    <div class="col-md-12">
        <p style="font-weight: bold;">{{ __("Registered by") }} <span style="font-style: italic;">{{ $product->user->name }}</span></p>
    </div>
    <div class="col-md-6 col-sm-12">
        <!-- Name Field -->
        <div class="form-group">
            {!! Form::label('name', __("product.columns.name") . ':') !!}
            <p>{{ $product->name }}</p>
        </div>

        <!-- Description Field -->
        <div class="form-group">
            {!! Form::label('description', __("product.columns.description") . ':') !!}
            <p>{{ $product->description }}</p>
        </div>

        <!-- Status Id Field -->
        <div class="form-group">
            {!! Form::label('status_id', __("product.columns.status_id") . ':') !!}
            <p>{{ $product->status->name }}</p>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <!-- Price Field -->
        <div class="form-group">
            {!! Form::label('price', __("product.columns.price") . ':') !!}
            <p>{{__("Currency Symbol")}} {{ str_replace('.', ',', str_replace(',', '', $product->price)) }}</p>
        </div>

        <!-- Image Field -->
        <div class="form-group">
            {!! Form::label('image', __("product.columns.image") . ':') !!}
            <img src="{{ $product->image }}" class="img-thumbnail" />
        </div>
    </div>
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        <br />
        <a href="{{ route('products.index') }}" class="btn btn-secondary">{{ __("Back") }}</a>
    </div>
</div>

