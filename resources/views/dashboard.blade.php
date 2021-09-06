@extends('layouts.app')

@section('title', 'Home')


@section('content')

    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card text-dark bg-light mb-3 text-center">
                <div class="card-header">Pedido de Compra</div>
                <div class="card-body">
                    <h3 class="card-title display-4">{{ $pedidoCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-dark bg-light mb-3 text-center">
                <div class="card-header">Cliente</div>
                <div class="card-body">
                    <h3 class="card-title display-4">{{ $clienteCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-dark bg-light mb-3 text-center">
                <div class="card-header">Produtos</div>
                <div class="card-body">
                    <h3 class="card-title display-4">{{ $produtoCount }}</h3>
                </div>
            </div>
        </div>
    </div>
@endsection

