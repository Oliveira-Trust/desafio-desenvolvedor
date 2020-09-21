@csrf

<div class="form-group">
    <label for="client_id">cliente</label>
    <select name="client_id" id="client_id" class="form-control">
        @foreach ($clients as $client)
            <option value="{{ $client->id }}" {{empty($order) ? "" : $order->order->client->id === $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="product_id">produto</label>
    <select name="product_id" id="product_id" class="form-control">
        @foreach ($products as $product)
            <option value="{{ $product->id }}" {{empty($order) ? "" : $order->product->name === $product->name  ? 'selected' : ''}}>{{ $product->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="status_id">status</label>
    <select name="status" id="status_id" class="form-control">
        <option value="pending" {{empty($order) ? "" : $order->status === 'pending' ? 'selected' : ''}}>pendente</option>
        <option value="paid" {{empty($order) ? "" : $order->status === 'paid' ? 'selected' : ''}}>pago</option>
        <option value="canceled" {{empty($order) ? "" : $order->status === 'canceled' ? 'selected' : ''}}>cancelado</option>
    </select>
</div>

<div class="form-group">
    <label for="quantity_id">quantidade</label>
    <input type="number" name="quantity" placeholder="quantidade" id="quantity_id"
           value="{{empty($order) ? "1" : $order->quantity}}" class="form-control" required>
</div>

<div class="form-group">
    <label>Valor total do pedido</label>
    <input type="number" name="price" id="price_id" placeholder="Preço do produto" class="form-control"
           value="{{empty($order) ? "0" : $order->price}}" required>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $(function (){
        var productId = $('#product_id').val()
        var price = $('#price_id').val();

        function callPrice(){
            jQuery.ajax({
                url: "{{ route('api.products.find')}}/"+productId,
                method: 'post',
                success: function(result){
                    let quantity = $('#quantity_id').val()
                    price=result.price * quantity
                    $('#price_id').val(result.price * quantity)
                    console.log(result.price, quantity)
                    price = 0
                },
                failure: function (result) {
                    alert("erro ao busca pedido");
                }
            });
        }

        $('#product_id').change(function (){
            productId = $('#product_id').val()
            callPrice()
        })

        $('#quantity_id').change(function (){
            callPrice()
        })

        $(function (){
            callPrice()
        })
    })
</script>
