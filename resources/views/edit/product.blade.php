@extends('layouts.app')

@section('content')
@if (session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

    <div class="card">
        <div class="card-header">
            <h1>Edição de Produtos</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('products.update', $product->id)}}">
                @csrf @method('PATCH')
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Descrição</label>
                        <input type="text" name="description" class="form-control" id="exampleInputEmail1" value="{{$product->description}}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Preço</label>
                        <input type="text" name="price" class="form-control" id="exampleInputPassword1" value="{{$product->price}}">
                    </div>                    
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="phone">Quantidade</label>
                        <input type="text" name="quantity" class="form-control" id="quantity" value="{{$product->quantity}}">
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary">Atualizar</button>
                <a href="{{route('products.index')}}" class="btn btn-secondary">Voltar</a>
              </form>
        </div>
      </div>
      
@endsection