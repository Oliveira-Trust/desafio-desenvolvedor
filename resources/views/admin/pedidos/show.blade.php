@extends('layouts.app')

@section('title') Pedido #{{$pedido->id}} @endsection

@section('content')
	<pedidos-show :pedido="{{ $pedido }}"></pedidos-show>
@endsection