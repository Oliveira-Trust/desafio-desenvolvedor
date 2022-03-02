@extends('layouts.app')

@section('content')

@if(session('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
    {{ session('error') }}
</div>
@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Alerta!</h5>
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container-fluid">
    <form class="row" method="POST" action="{{ route('cotacao-preco.converte') }}">
        @csrf
        <div class="form-group col-2">
            <label>Moeda de origem:</label>
            <input type="text" name="origem_moeda" readonly value="{{$moedaOrigem['BRL']}}" class="@error('origem_moeda') is-invalid @enderror form-control">
            @error('origem_moeda')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group col-2">
            <label>Moeda de destino:</label>
            <select class="@error('destino_meda') is-invalid @enderror form-control" name="destino_meda">
                @foreach ($moedaDestino as $moeda)
                <option value="{{$moeda}}">{{$moeda}}</option>
                @endforeach
            </select>
            @error('destino_meda')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group col-2">
            <label>Valor:</label>
            <input type="number" name="valor" class="form-control" value="">
            @error('valor')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group col-2">
            <label>Forma de pagamento:</label>
            <select class="form-control" name="meio_pagamento_id">
                @foreach ($meioPagamentos as $meio)
                <option value="{{$meio->id}}">{{$meio->meio_pagamento}}</option>
                @endforeach
            </select>
            @error('payment_method')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group col-2 pt-4">
            <button type="submit" class="btn btn-primary btn-sm">Converter</button>
        </div>
    </form>


    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Moeda de origem</th>
                <th scope="col">Moeda de destino</th>
                <th scope="col">Valor para conversão</th>
                <th scope="col">Forma de pagamento</th>
                <th scope="col">Valor da moeda</th>
                <th scope="col">Valor comprado</th>
                <th scope="col">Taxa de Pagamento</th>
                <th scope="col">Taxa de conversão</th>
                <th scope="col">Conversão de base de valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cotacoes as $cotacao)
            <tr>
                <td>{{ $cotacao->origem_moeda }}</td>
                <td>{{ $cotacao->destino_meda }}</td>
                <td>{{ number_format($cotacao->valor, 2, ',', '.') }}</td>
                <td>{{ $cotacao->MeioPagamento->meio_pagamento }}</td>
                <td>{{ number_format($cotacao->valor_moeda, 2, ',', '.')  }}</td>
                <td>{{ number_format($cotacao->preco_compra, 2, ',', '.') }}</td>
                <td>{{ number_format($cotacao->taxa_pagamento, 2, ',', '.') }}</td>
                <td>{{ $cotacao->taxa_conversao }} %</td>
                <td>{{ number_format($cotacao->valor - $cotacao->taxa_pagamento - $cotacao->taxa_conversao, 2, ',', '.') }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection