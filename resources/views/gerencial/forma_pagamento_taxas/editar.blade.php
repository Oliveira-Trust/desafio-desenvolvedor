@extends('layouts.sb-admin-2.projeto.corpo')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-money-bill"></i> Editar Taxas de Formas de Pagamento </h1>
    <nav aria-label="breadcrumb-gv">
        <ol class="breadcrumb-gv">
            <li class="breadcrumb-gv-item"><a class="text-dark" href="{{ route('home') }}"><i class="fas fa-fw fa-home"></i> Inicio</a></li>
            <li class="breadcrumb-gv-item"><a class="text-dark" href="{{ route('forma_pagamento_taxas.index') }}"><i class="fas fa-money-bill"></i> Taxas de Formas de Pagamento</a></li>
            <li class="breadcrumb-gv-item active">Editar</li>
        </ol>
    </nav>
</div>
<div class="alert alert-warning margin-top-0">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    Os campos marcados com <b class="text-danger">*</b> são de preenchimento obrigatório.
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <strong>Atenção!</strong> Ocorreram erros no formulário.
    </div>
    <!-- <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul> -->
@endif
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('forma_pagamento_taxas.atualizar',$formaPagamentoTaxa->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('gerencial.forma_pagamento_taxas.campos')
            <button type="submit" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Atualizar</span>
            </button>
            <a href="{{ route('forma_pagamento_taxas.index') }}" class="btn btn-danger btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-times-circle"></i>
                </span>
                <span class="text">Cancelar</span>
            </a>
        </form>
    </div>
</div>
@endsection