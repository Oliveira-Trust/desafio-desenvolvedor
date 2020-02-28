@extends('layouts.app')

@section('content')
@if (session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

    <div class="card">
        <div class="card-header">
            <h1>Cadastro de Produto</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('products.store')}}">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="">Descrição</label>
                        <input type="text" name="description" class="@error('description') is-invalid @enderror form-control" id="description" value="{{old('description')}}">
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror                        
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="">Preço</label>
                        <input type="text" name="price" class="@error('price') is-invalid @enderror form-control" id="price" value="{{old('price')}}">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror                        
                    </div>                    
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="phone">Quantidade</label>
                        <input type="text" name="quantity" class="@error('quantity') is-invalid @enderror form-control" id="quantity" value="{{old('quantity')}}">
                        @error('quantity')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror                        
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary">Cadastrar</button>
                <a href="{{route('products.index')}}" class="btn btn-secondary">Voltar</a>
              </form>
        </div>
      </div>
      
@endsection