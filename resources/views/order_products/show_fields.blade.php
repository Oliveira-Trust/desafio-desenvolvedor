<!-- Qnt Field -->
<div class="form-group">
    {!! Form::label('qnt', 'Qnt:') !!}
    <p>{{ $orderProducts->qnt }}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', 'Price:') !!}
    <p>{{ $orderProducts->price }}</p>
</div>

<!-- Order Id Field -->
<div class="form-group">
    {!! Form::label('order_id', 'Order Id:') !!}
    <p>{{ $orderProducts->order_id }}</p>
</div>

<!-- Product Id Field -->
<div class="form-group">
    {!! Form::label('product_id', 'Product Id:') !!}
    <p>{{ $orderProducts->product_id }}</p>
</div>

