@extends('layouts.app')
@section('title')
Cliente     
@endsection
@section('content')
<button type="button" class="btn btn-primary" onclick="window.location='{{route('novo_cliente')}}'">Inserir novo cliente</button>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Ação</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)
      <tr>
        <th scope="row">{{$cliente->id}}</th>
        <td>{{$cliente->nome}}</td>
        <td></td>
      </tr>
      @endforeach
    </tbody>
  </table>

@endsection
