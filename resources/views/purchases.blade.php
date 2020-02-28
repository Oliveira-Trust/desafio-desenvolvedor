@extends('layouts.app')

@section('content')
@if (session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

<div class="row">
  <div class="col"><h1>Pedidos</h1></div>
  <div class="col">
      <div class="float-right">
        <a href="{{route('purchases.create')}}" class="btn btn-success">
         <i class="fas fa-plus"></i> Novo Pedido
        </a>
      </div>
  </div>
</div>

<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Cliente</th>
        <th scope="col">Produto</th>
        <th scope="col">Quantidade</th>
        <th scope="col">Status</th>
        <th>Editar</th>
      </tr>
    </thead>
    <tbody id="tbody">
        @foreach ($purchases as $purchase)            
        <tr>
          <td>{{$purchase->id}}</td>
          <td>
            <a href="{{route('clients.show', $purchase->client->id)}}">
              {{$purchase->client->name}} <i class="fas fa-external-link-alt"></i>
            </a>
          </td>
          <td>
            <a href="{{route('products.show', $purchase->product->id)}}">
            {{$purchase->product->description}} <i class="fas fa-external-link-alt"></i></a>
          </td>
          <td>{{$purchase->quantity}}</td>
          <td>{{$purchase->status}}</td>
          <td>
              <a href="{{route('purchases.show', $purchase->id)}}" class="btn btn-primary">Detalhes</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

@endsection