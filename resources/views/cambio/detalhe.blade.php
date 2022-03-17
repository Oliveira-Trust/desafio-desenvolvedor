@extends('layout')

@section('content')
<div class="pricing-header p-3 pb-md-4 text-left">
    <h1 class="display-8 fw-normal">Detalhe</h1>
    <p class="fs-5 text-muted">Cambio realizado {{ date('d/m/Y', strtotime($cambio->created_at)) }}</p>
</div>
</header>

<main>
    <div class="row row-cols-1 row-cols-md-3 mb-3">
        <div class="col-md-12">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-6">
                            <h4 class="display-8 fw-normal">Moeda Origem: {{ $cambio->origem_descricao }}</h4>
                        </div>
                        <div class="col-6">
                            <h4 class="display-8 fw-normal">Moeda Destino: {{ $cambio->origem_descricao }}</h4>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-6">
                            <h4 class="display-8 fw-normal">Valor para Conversão: {{ $cambio->origem_sigla }} {{ number_format($cambio->valor_conversao, 2, ',', '.') }}</h4>
                        </div>
                        <div class="col-6">
                            <h4 class="display-8 fw-normal">Forma de Pagamento: {{ $cambio->forma_descricao }}</h4>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-6">
                            <h4 class="display-8 fw-normal">Taxa de Pagamento: {{ $cambio->origem_sigla }} {{ number_format($cambio->valor_taxa_pagamento, 2, ',', '.') }}</h4>
                        </div>
                        <div class="col-6">
                            <h4 class="display-8 fw-normal">Taxa de Conversão: {{ $cambio->origem_sigla }} {{ number_format($cambio->valor_taxa_conversao, 2, ',', '.') }}</h4>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-6">
                            <h4 class="display-8 fw-normal">Valor Usado para Conversão: {{ $cambio->origem_sigla }} {{ number_format($cambio->valor_moeda_destino, 2, ',', '.') }}</h4>
                        </div>
                        <div class="col-6">
                            <h4 class="display-8 fw-normal">Valor com Descontos: {{ $cambio->origem_sigla }} {{ number_format($cambio->valor_descontado, 2, ',', '.') }}</h4>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12">
                            <h4 class="display-8 fw-normal">Valor Comprado: {{ $cambio->destino_sigla }} {{ number_format($cambio->valor_comprado, 2, ',', '.') }}</h4>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12 d-flex justify-content-between">
                            <a href="{{ url('/') }}" class="btn btn-secondary">Ir para Cambio</a>
                            <a href="{{ url('/historico') }}" class="btn btn-primary">Ir para Histórico</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection