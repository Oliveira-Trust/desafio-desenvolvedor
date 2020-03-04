@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 mb-4">
            <div class="card">
                <div class="card-header bg-info text-white">Detalhes do Cliente</div>

                <div class="card-body">
                    <div class="font-weight-bold">Nome: {{ $client->name }}</div>
                    <div class="font-weight-bold">Data de Nascimento: {{ date('d/m/Y', strtotime($client->datebirth)) }}</div>
                    <div class="font-weight-bold">CPF: {{ $client->cpf }}</div>
                    <div class="font-weight-bold">Telefone: {{ $client->telephone }}</div>
                    <div class="font-weight-bold mt-3">Total de Pedidos Realizados: {{ $purchaseRequests }}</div>
                </div>
            </div>
            
            <a href="{{ route('purchase-requests.index') }}" class="btn btn-secondary mt-3">Voltar</a>
        </div>
    </div>
</div>
@endsection
