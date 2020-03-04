@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">Cadastro de Pedido</h2>
    
    <form action="{{ route('purchase-requests.store') }}" method="POST" autocomplete="off">

        @csrf

        <div class="form-group form-row">
            <div class="col-lg-6">
                <label for="client">Cliente:</label>
                <select name="id_client" class="form-control" id="client">
                    <option>Selecione</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
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
                        <option value="{{ $product->id }}">{{ $product->name }} ({{ number_format($product->price, 2, ',', '.') }})</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group form-row">
            <div class="col-lg-2">
                <label for="quantity">Quantidade:</label>
                <input type="number" name="quantity" class="form-control" id="quantity" min="1" />
            </div>
            
            <div class="col-lg-4">
                <label for="status">Status:</label>
                <select name="status" class="form-control" id="status">
                    <option>Selecione</option>
                    <option value="1">Em Aberto</option>
                    <option value="2">Pago</option>
                    <option value="0">Cancelado</option>
                </select>
            </div>
        </div>
        
        <button type="submit" class="btn btn-info text-white">Cadastrar Pedido</button>
        <a href="{{ route('purchase-requests.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection