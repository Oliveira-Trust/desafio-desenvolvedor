@extends('layouts.app')
@section('content')

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Descrição</th>
        <th scope="col">Valor</th>
        <th scope="col">Quantidade</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
        @foreach ($produtos as $produto)
      <tr>
        <th scope="row">{{$produto['id']}}</th>
        <td>{{$produto['descricao']}}</td>
        <td>{{$produto['valor']}}</td>
        <td>{{$produto['quantidade']}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

@endsection
