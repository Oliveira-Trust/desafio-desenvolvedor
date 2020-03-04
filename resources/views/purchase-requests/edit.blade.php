@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">Edição de Pedido</h2>
    
    <form action="{{ route('purchase-requests.update', ['id' => $request->id]) }}" method="POST" autocomplete="off">

        @csrf
        @method('PUT')

        <div class="form-group form-row">
            <div class="col-lg-6">
                <label for="client">Cliente:</label>
                <select name="id_client" class="form-control" id="client">
                    <option>Selecione</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" <?= ($client->id == $request->client()->id ? 'selected' : ''); ?>>
                            {{ $client->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group form-row">
            <div class="col-lg-6">
                <label for="product">Produto:</label>
                <select name="id_product" class="form-control" id="product">
                    <option>Selecione</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" <?= ($product->id == $request->product()->id ? 'selected' : ''); ?>>
                            {{ $product->name }} ({{ number_format($product->price, 2, ',', '.') }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="form-group form-row">
            <div class="col-lg-2">
                <label for="quantity">Quantidade:</label>
                <input type="number" name="quantity" class="form-control" id="quantity" min="1" value="{{ $request->quantity }}" />
            </div>
            
            <div class="col-lg-4">
                <label for="status">Status:</label>
                <select name="status" class="form-control" id="status">
                    <option>Selecione</option>
                    <option value="1" <?= ($request->status == 1 ? 'selected' : ''); ?>>Em Aberto</option>
                    <option value="2" <?= ($request->status == 2 ? 'selected' : ''); ?>>Pago</option>
                    <option value="0" <?= ($request->status == 0 ? 'selected' : ''); ?>>Cancelado</option>
                </select>
            </div>
        </div>
        
        <button type="submit" class="btn btn-info text-white">Editar Pedido</button>
        <a href="{{ route('purchase-requests.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection