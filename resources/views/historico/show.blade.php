@extends('layouts.app')
@section('content')

<div class="card-header">{{ __('Conversão de Moeda:') }}</div>


@if (session('status'))
<div class="alert alert-success">{{ session('status') }}</div>
@endif

<div class="mb-3 row">
    <label class="form-label col-sm-2"><b>Valor de Conversão:</b></label>
    <div class="col-sm-10">
        {{ $historico->valor_conversao }}
    </div>
</div>

<div class="mb-3 row">
    <label class="form-label col-sm-2"><b>Moeda de Origem:</b></label>
    <div class="col-sm-10">
        {{ $historico->moeda_origem }}
    </div>
</div>

<div class="mb-3 row">
    <label class="form-label col-sm-2"><b>Moeda de Destino:</b></label>
    <div class="col-sm-10">
        {{ $historico->moeda_destino }}
    </div>
</div>

<div class="mb-3 row">
    <label class="form-label col-sm-2"><b>Forma de Pagamento:</b></label>
    <div class="col-sm-10">
        {{ $historico->forma_pagamento }}
    </div>
</div>

<div class="mb-3 row">
    <label class="form-label col-sm-2"><b>Valor Moeda de Destino:</b></label>
    <div class="col-sm-10">
        {{ $historico->valor_moeda_destino }}
    </div>
</div>

<div class="mb-3 row">
    <label class="form-label col-sm-2"><b>Valor Comprado:</b></label>
    <div class="col-sm-10">
        {{ $historico->valor_comprado . ' ' . $historico->moeda_destino }}
    </div>
</div>

<div class="mb-3 row">
    <label class="form-label col-sm-2"><b>Taxa de Pagamento:</b></label>
    <div class="col-sm-10">
        {{ $historico->taxa_pagamento }}
    </div>
</div>

<div class="mb-3 row">
    <label class="form-label col-sm-2"><b>Taxa de Conversao:</b></label>
    <div class="col-sm-10">
        {{ $historico->taxa_conversao }}
    </div>
</div>

<div class="mb-3 row">
    <label class="form-label col-sm-2"><b>Total Descontato:</b></label>
    <div class="col-sm-10">
        R$ {{ $historico->total_descontato }}
    </div>
</div>

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a type="button" href="{{ route('conversoes') }}" class="btn btn-secondary">Voltar Conversões</a>
    <a type="button" href="{{ route('conversao.mail', $historico->id ) }}" class="btn btn-primary">Enviar no E-mail</a>
</div>

@endsection
