@extends('layouts.dashboard.admin')
@section('title', 'Visualizar Pedido')
@section('search-route', route('users.search'))

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pedido</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{route('orders.index')}}" class="btn btn-primary btn-sm">Voltar</a>
        </div>
      </div>

      @if($message = Session::get('success'))
      <x-alert-success>
            {{$message}}
      </x-alert-success>
    @endif

      @if($message = Session::get('error'))
        <x-alert-danger>
              {{$message}}
        </x-alert-danger>
      @endif

      <div class="card">
        <div class="card-header">
          Dados do Pedido
        </div>
        <div class="card-body">
        <h5 class="card-title">Staus: {{$order->status}} </h5>
          <p class="card-text">
            <p> <i>Usuário: </i> <strong>{{$order->owner->name}}({{$order->owner->email}})</strong></p>
            <p> <i>Valor: </i> <strong>{{$order->value}}</strong></p>
             <p><i>Data do pedido:</i> <strong>{{$order->created_at->format('d/m/Y')}}</strong></p>
          </p>
          <hr>
          <h3>Lista de Produtos</h3>
          <ul class="list-group list-group-flush">
              @foreach ($products as $product)
              <li class="list-group-item">{{$product->name}}</li>
              @endforeach
          </ul>
        </div>
        <div class="card-footer">
        <p>Valor total: R${{$order->value}}</p>
        </div>

      </div>

@endsection

