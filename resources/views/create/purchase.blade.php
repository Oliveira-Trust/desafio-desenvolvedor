@extends('layouts.app')

@section('content')
@if (session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

    <div class="card">
        <div class="card-header">
            <h1>Cadastro de Pedido</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('purchases.store')}}">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="">Cliente</label>
                        <select name="client_id" id="client_id" class="@error('client_id') is-invalid @enderror form-control">
                            <option value="">Selecione</option>
                            @foreach ($clients as $client)
                                <option value="{{$client->id}}">{{$client->name}}</option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror                        
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Produto</label>
                        <select name="product_id" id="product_id" class="@error('product_id') is-invalid @enderror form-control">
                            <option value="">Selecione</option>
                            @foreach ($products as $product)
                                <option value="{{$product->id}}">{{$product->description}}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>                    
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="">Quantidade</label>
                        <input type="text" name="quantity" class="@error('quantity') is-invalid @enderror form-control" id="quantity" value="{{old('quantity')}}">
                        @error('quantity')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror                        
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary">Cadastrar</button>
                <a href="{{route('purchases.index')}}" class="btn btn-secondary">Voltar</a>
              </form>
        </div>
      </div>
      
@endsection