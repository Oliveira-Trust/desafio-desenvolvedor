@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">Cadastro de Produtos</h2>
    
    <form action="{{ route('products.store') }}" method="POST" autocomplete="off">

        @csrf

        <div class="form-group form-row">
            <div class="col-lg-6">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-lg-6">
                <label for="price">Preço:</label>
                <input type="text" class="form-control maskMoney" id="price" name="price" required>
            </div>
        </div>

        <button type="submit" class="btn btn-info text-white">Cadastrar Produto</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection