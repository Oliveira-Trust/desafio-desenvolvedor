@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header bg-info text-white"><i class="fa fa-users"></i> Clientes</div>

                <div class="card-body">
                    <div class="font-weight-bold">{{ $clients }}</div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header bg-info text-white"><i class="fa fa-archive"></i> Produtos</div>

                <div class="card-body">
                    <div class="font-weight-bold">{{ $products }}</div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header bg-info text-white"><i class="fa fa-dollar"></i> Pedidos de Compra</div>

                <div class="card-body">
                    <div class="font-weight-bold">{{ $purchaseRequests }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
