@extends('layouts.app')

@section('content')
    <div class="container" id="containerPedido">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                {{ \Session::get('success') }}
            </div>
        @endif
            @if (\Session::has('errors'))
                <div class="alert alert-danger">
                    {{ \Session::get('errors') }}
                </div>
            @endif
        <a href="{{route('pedidos.criacao')}}" class="btn btn-info" style="float:left" >Criar Novo Pedido</a>
        {{$listOrders}}
    </div>
@endsection
