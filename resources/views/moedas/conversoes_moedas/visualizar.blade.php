@extends('layouts.sb-admin-2.projeto.corpo')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-money-bill"></i> Visualizar Cotação </h1>
    <nav aria-label="breadcrumb-gv">
        <ol class="breadcrumb-gv">
            <li class="breadcrumb-gv-item"><a class="text-dark" href="{{ route('home') }}"><i class="fas fa-fw fa-home"></i> Inicio</a></li>
            <li class="breadcrumb-gv-item"><a class="text-dark" href="{{ route('conversoes_moedas.index') }}"><i class="fas fa-money-bill"></i> Cotações</a></li>
            <li class="breadcrumb-gv-item active">Visualizar</li>
        </ol>
    </nav>
</div>
    
    <div class="row pt-4">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Moeda de origem:</strong>
                {{ $conversaoMoeda->moeda_origem.' - Real' }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Moeda de destino:</strong>
                {{ $conversaoMoeda->moeda_destino.' - '.($conversaoMoeda->moeda_destino == 'USD' ? 'Dollar Americano' : 'Euro') }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Forma de pagamento:</strong>
                {{ ($conversaoMoeda->forma_pagamento == 'B' ? 'Boleto' : 'Cartão')  }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Valor para conversão:</strong>
                R$ {{ \App\Helpers\FormataHelper::formataValor($conversaoMoeda->valor_conversao)  }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Taxa de pagamento:</strong>
                R$ {{ \App\Helpers\FormataHelper::formataValor($conversaoMoeda->taxa_pagamento)  }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Taxa de conversão:</strong>
                R$ {{ \App\Helpers\FormataHelper::formataValor($conversaoMoeda->taxa_conversao)  }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Valor utilizado para conversão:</strong>
                R$ {{ \App\Helpers\FormataHelper::formataValor($conversaoMoeda->valor_final_conversao)  }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Valor moeda de destino:</strong>
                R$ {{ \App\Helpers\FormataHelper::formataValor($conversaoMoeda->valor_moeda_destino)  }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Valor comprado:</strong>
                R$ {{ \App\Helpers\FormataHelper::formataValor($conversaoMoeda->valor_comprado_moeda_destino)  }}
            </div>
        </div>
    </div>
@endsection