@extends('layouts.dashboard.admin')
@section('title', 'Lista de Pedidos')
@section('search-route', route('orders.search'))

@section('content')
 <main>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pedidos</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{route('orders.create')}}" class="btn btn-primary btn-sm">Adicionar</a>
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

     @if(count($orderList) < 1)
        <div class="alert alert-dark" role="alert">
            Não foram encontrados pedidos cadastrados!
        </div>
     @else
        <div class="table-responsive">
            <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Valor</th>
                    <th>Usuário</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderList as $key => $order)
                <tr>
                    <td>{{$order->value}}</td>
                    <td>{{$order->owner->name}}</td>
                    <td>{{$order->status}}</td>
                    <td>
                        <a class="btn btn-sm btn-light" href="{{route('orders.show',[$order->id])}}">Visualizar</a>
                        <a class="btn btn-sm btn-warning" href="{{route('orders.edit',$order)}}">Editar</a>
                        <a class="btn btn-sm btn-danger" href="{{route('orders.destroy',[$order->id])}}" >Apagar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
            @if($orderList->contains('links'))
            {{$orderList->links()}}
            @endif()
        </div>
    @endif
</main>
@endsection

