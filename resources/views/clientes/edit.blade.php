@extends('layouts.app')

@section('title')
Cliente - Inserir     
@endsection

@section('content')
<form class="row g-3" method="POST" action="{{route('salvar_cliente')}}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="{{ $cliente->nome }}">
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
@endsection