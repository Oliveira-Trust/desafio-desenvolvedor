@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h1>Detalhes de Produto</h1>
    </div>
    <div class="card-body">
        <form method="POST" action="{{route('products.destroy', $product->id)}}">
            @csrf @method('DELETE')
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="name">Descrição</label>
                    <input type="text" name="description" class="form-control" id="description" value="{{$product->description}}" readonly>
                </div>
                <div class="form-group col-sm-6">
                    <label for="cpf">Preço</label>
                    <input type="text" name="price" class="form-control" id="price" value="{{$product->price}}" readonly>
                </div>                    
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="phone">Quantidade</label>
                    <input type="text" name="quantity" class="form-control" id="quantity" value="{{$product->quantity}}" readonly>
                </div>
            </div>
            <a href="{{route('products.edit', $product->id)}}" class="btn btn-primary">Editar</a>
            <button type="submit" class="btn btn-danger">Deletar</a>
        </form>
    </div>
  </div>

@endsection