<div class="row">
    <div class="col-md-12">
        <p style="font-weight: bold;">{{ __("Registered by") }} <span
                style="font-style: italic;">{{ $order->user->name }}</span></p>
    </div>
    <div class="col-md-6 col-sm-12">
        <!-- Client Id Field -->
        <div class="form-group">
            {!! Form::label('client_id', __("order.columns.client_id") . ':') !!}
            <p>{{ $order->client->name }}</p>
        </div>

        <!-- Status Id Field -->
        <div class="form-group">
            {!! Form::label('status_id', __("order.columns.status_id") . ':') !!}
            <p>{{ $order->status->name }}</p>
        </div>

        <!-- Status Id Field -->
        <div class="form-group">
            {!! Form::label('status_id', __("order.columns.total") . ':') !!}
            <p id="total-products"></p>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        {!! Form::label('status_id', __("order.columns.products") . ':') !!}
        <div class="row">
            <div class="col-md-12">
                <ul id="products-list" class="list-group">
                </ul>
            </div>
        </div>
        <br />
    </div>
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        <br />
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">{{ __("Back") }}</a>
    </div>
</div>


@push('scripts')
<script type="text/javascript">
    $(function() { addProduct({!! json_encode($order->ordersProducts) !!}); });
    function addProduct(aProducts = false) {
        if (aProducts) {
            var total = 0;
            $('#products-list').html('');
            $('#total-products').html('');
            $.each(aProducts, function (index, object) {
                $('#products-list').append('<li class="product-item list-group-item d-flex justify-content-between align-items-center" data-id="' + object.product_id + '"><p>' + object.qnt + 'x ' + object.product.name + '<br />' + formatMoneyBr(object.price) + '</p><img class="float-right" src="' + object.product.image + '" height="120px"></li>');
                total = (parseFloat(total)+parseFloat(object.price));
            });
            $('#total-products').text(formatMoneyBr(total));
            return;
        }
        return;
    }
</script>
@endpush