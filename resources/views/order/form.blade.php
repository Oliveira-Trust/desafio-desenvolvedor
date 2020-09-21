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
    <input type="number" name="quantity" placeholder="quantidade"
           value="{{empty($order) ? "0" : $order->quantity}}" class="form-control" required>
</div>

