@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">Edição de Produto</h2>
    
    <form action="{{ route('products.update', ['id' => $product->id]) }}" method="POST" autocomplete="off">

        @csrf
        @method('PUT')
        
        <div class="form-group form-row">
            <div class="col-lg-6">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
            </div>
            
            <div class="col-lg-6">
                <label for="price">Preço:</label>
                <input type="text" class="form-control maskMoney" id="price" name="price" value="{{ $product->price }}" required>
            </div>
        </div>

        <button type="submit" class="btn btn-info text-white">Editar Produto</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection