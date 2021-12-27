@extends('template.template')

@section('title','Dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Histórico') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Conversão</th>
                                    <th scope="col">Valor de Compra</th>
                                    <th scope="col">Pagamento</th>
                                    <th scope="col">Valor Moeda</th>
                                    <th scope="col">Valor Comprado</th>
                                    <th scope="col">Taxa Pagamento</th>
                                    <th scope="col">Taxa Conversão</th>
                                    <th scope="col">Valor Final</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dados as $dt)
                                    <tr>
                                        <th scope="row">{{$dt->id}}</th>
                                        <td>{{$dt->moeda_origem}}/{{$dt->moeda_destino}}</td>
                                        <td>{{$dt->valor_conversao_original}}</td>
                                        <td>{{$dt->forma_pagamento}}</td>
                                        <td>{{$dt->valor_moeda}}</td>
                                        <td>{{number_format($dt->valor_comprado,2,',','.')}}</td>
                                        <td>{{number_format($dt->valor_taxa_pagamento,2,',','.')}}</td>
                                        <td>{{number_format($dt->valor_taxa_conversao,2,',','.')}}</td>
                                        <td>{{$dt->valor_conversao_com_taxa}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
