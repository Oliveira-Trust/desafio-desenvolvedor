@extends('layouts.dashboard.admin')
@section('title', 'Visualizar Pedidos Usuário')
@section('search-route', route('users.search'))

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{$user->name}}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{route('users.index')}}" class="btn btn-primary btn-sm">Voltar</a>
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

      <div class="row d-flex justify-content-center align-content-center">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title"><strong>Pedidos usuário: {{$user->name}}</strong></h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach ($user->orders as $order)
                       <li class="list-group-item">Data: {{$order->created_at->format('d/m/Y')}} -    Status {{$order->status}} - Valor {{$order->value}}
                        <a class="btn btn-sm btn-info" href="{{route('orders.show',[$order->id])}}">Detalhes</a>
                    </li>
                    @endforeach
                </ul>
            </div>
          </div>
      </div>

@endsection

