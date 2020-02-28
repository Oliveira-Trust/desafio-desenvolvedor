@extends('layouts.app')

@section('content')
@if (session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

<div class="row">
  <div class="col"><h1>Produtos</h1></div>
  <div class="col">
      <div class="float-right">
        <a href="{{route('products.create')}}" class="btn btn-success">
         <i class="fas fa-plus"></i> Novo Produto
        </a>
      </div>
  </div>
</div>

<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Descrição</th>
        <th scope="col">Preço</th>
        <th scope="col">Quantidade</th>
        <th>Editar</th>
      </tr>
    </thead>
    <tbody id="tbody">
        @foreach ($products as $product)            
        <tr>
          <td>{{$product->id}}</td>
          <td>{{$product->description}}</td>
          <td>{{$product->price}}</td>
          <td>{{$product->quantity}}</td>
          <td>
              <a href="{{route('products.show', $product->id)}}" class="btn btn-primary">Detalhes</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

@endsection