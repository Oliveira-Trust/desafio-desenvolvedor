@extends('layouts.app')
@section('title')
Produto     
@endsection
@section('content')
<button type="button" class="btn btn-primary" onclick="window.location='{{route('novo_produto')}}'">Inserir novo produto</button>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Descrição</th>
        <th scope="col">Valor</th>
        <th scope="col">Quantidade</th>
        <th scope="col">Ação</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($produtos as $produto)
      <tr>
        <th scope="row">{{$produto->id}}</th>
        <td>{{$produto->descricao}}</td>
        <td>{{$produto->valor}}</td>
        <td>{{$produto->quantidade}}</td>
        <td></td>
      </tr>
      @endforeach
    </tbody>
  </table>

@endsection
