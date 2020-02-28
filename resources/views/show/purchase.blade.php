@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h1>Detalhes de Pedido</h1>
    </div>
    <div class="card-body">
        <form method="POST" action="{{route('purchases.destroy', $purchase->id)}}">
            @csrf @method('DELETE')
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="name"><a href="{{route('clients.show', $purchase->client->id)}}">Cliente <i class="fas fa-external-link-alt"></i></a></label>
                    <input type="text" name="client_id" class="form-control" id="client" value="{{$purchase->client->name}}" readonly>                    
                </div>
                <div class="form-group col-sm-6">
                    <label for="cpf"><a href="{{route('products.show', $purchase->product->id)}}">Produto <i class="fas fa-external-link-alt"></i></a></label>
                    <input type="text" name="product_id" class="form-control" id="product" value="{{$purchase->product->description}}" readonly>
                </div>                    
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="phone">Quantidade</label>
                    <input type="text" name="quantity" class="form-control" id="quantity" value="{{$purchase->quantity}}" readonly>
                </div>
                <div class="form-group col-sm-6">
                    <label for="address">Status</label>
                    <input type="text" name="status" class="form-control" id="status" value="{{$purchase->status}}" readonly>
                </div>
            </div>
            <a href="{{route('purchases.edit', $purchase->id)}}" class="btn btn-primary">Editar</a>
            <button type="submit" class="btn btn-danger">Deletar</a>
        </form>
    </div>
  </div>

@endsection