@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Logs') }}</div>

                    <div class="card-body">
                        <table id="logsTable" class="display table table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Usuário</th>
                                <th>Moeda de Origem</th>
                                <th>Valor Entrada</th>
                                <th>Moeda de Destino</th>
                                <th>Valor Saída</th>
                                <th>Forma de Pagamento</th>
                                <th>Criado em</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($logs as $log)
                                <tr>
                                    <td class="text-center">{{ $log->id }}</td>
                                    <td>{{ $log->user->name }}</td>
                                    <td>{{ $log->moeda_origem }}</td>
                                    <td>{{ $log->valor_entrada }}</td>
                                    <td>{{ $log->moeda_destino }}</td>
                                    <td>{{ $log->valor_saida }}</td>
                                    <td>{{ $log->forma_pagamento }}</td>
                                    <td>{{ $log->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div>
                            <a class="btn btn-secondary" href="{{ route('cambio.index') }}">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
