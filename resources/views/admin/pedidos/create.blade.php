@extends('layouts.app')

@section('title') Adicionar Pedido @endsection

@section('content')
	<pedidos-form :errors="{{ json_encode($errors->getMessages()) }}" :clients="{{ $clients }}"></pedidos-form>
@endsection