<div class="row">
    <div class="col-md-6 col-sm-12">
        @if (empty($product))
        {!! Form::hidden('user_id', \Auth::user()->id) !!}
        @else
        {!! Form::hidden('user_id', $product->user_id) !!}
        @endif
        <!-- Client Id Field -->
        <div class="form-group">
            {!! Form::label('client_id', __("order.columns.client_id") . ':') !!}
            {!! Form::select('client_id', $clients, null, ['class' => 'form-control']) !!}
        </div>

        <!-- Status Id Field -->
        <div class="form-group">
            {!! Form::label('status_id', __("order.columns.status_id") . ':') !!}
            {!! Form::select('status_id', $statuses, null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <!-- Products Field -->
        <div class="form-group">
            {!! Form::label('products', __("order.columns.products") . ':') !!}
            <div class="row">
                <div class="col-md-3">
                    <input id="products-qnt" class="form-control" type="number" min="1" value="1" placeholder="{{ __("Qnt") }}">
                </div>
                <div class="col-md-9">
                    <div class="input-group">
                        <select id="products" class="form-control">
                            @foreach($products as $product)
                            <option data-img="{{ $product['image'] }}" data-price="{{ $product['price'] }}"
                                value="{{ $product['id'] }}">{{ $product['name'] }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <a href="javascript:void(0);" class="btn btn-outline-info" onclick="addProduct()">{{ __("Add") }}</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <ul id="products-list" class="list-group">
                    </ul>
                </div>
            </div>
            <br />
        </div>
    </div>
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit(__("Save"), ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">{{ __("Cancel")}}</a>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    @if(!empty($order)) $(function() { addProduct({!! json_encode($order->ordersProducts) !!}); }); @endif
    function addProduct(aProducts = false) {
        if (aProducts) {
            $('#products-list').html('');
            $.each(aProducts, function (index, object) {
                $('#products-list').append('<li class="product-item list-group-item d-flex justify-content-between align-items-center" data-id="' + object.product_id + '"><p>' + object.qnt + 'x ' + object.product.name + '<br />' + formatMoneyBr(object.price) + '</p><img class="float-right" src="' + object.product.image + '" height="120px"><span onclick="$(\'.product-item[data-id=' + object.product_id + ']\').remove();" class="badge badge-primary badge-pill">&times;</span><input type="hidden" value=\'{"id":' + object.product_id + ',"qnt":' + object.qnt + ',"price":' + (object.price/object.qnt) + '}\' name="products[]" /></li>');
            });
            return;
        }
        let qnt = $('#products-qnt').val();
        let productId = $('#products option:selected').val();
        let productName = $('#products option:selected').text();
        let productPrice = $('#products option:selected').attr('data-price');
        let productImg = $('#products option:selected').attr('data-img');
        $('#products-list').append('<li class="product-item list-group-item d-flex justify-content-between align-items-center" data-id="' + productId + '"><p>' + qnt + 'x ' + productName + '<br />' + formatMoneyBr(qnt * productPrice) + '</p><img class="float-right" src="' + productImg + '" height="120px"><span onclick="$(\'.product-item[data-id=' + productId + ']\').remove();" class="badge badge-primary badge-pill">&times;</span><input type="hidden" value=\'{"id":' + productId + ',"qnt":' + qnt + ',"price":' + productPrice + '}\' name="products[]" /></li>');
        return;
    }
</script>
@endpush