@extends('layouts.app')

@section('title') Editar Pedido #{{$pedido->id}}@endsection

@section('content')
	<pedidos-form :errors="{{ json_encode($errors->getMessages()) }}" :order-data="{{ $pedido }}" :in-edit="true" :clients="{{ $clients }}"></pedidos-form>
@endsection