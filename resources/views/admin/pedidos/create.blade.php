@extends('layouts.app')

@section('title') Adicionar Pedido @endsection

@section('content')
	<pedidos-form :errors="{{ json_encode($errors->getMessages()) }}" :categories="{{ $categories }}" :clients="{{ $clients }}"></pedidos-form>
@endsection