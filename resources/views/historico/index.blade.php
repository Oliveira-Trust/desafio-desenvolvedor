@extends('layouts.master')

@section('h1', 'Histórico de Transações')

@section('content')
    <div class="card">

        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Moeda de Origem</th>
                    <th>Moeda Destino</th>
                    <th>Valor</th>
                    <th>Pagamento</th>
                    <th>Taxa de Pagamento</th>
                    <th>Taxa de Conversão</th>
                    <th>Valor da Transação</th>
                    <th>Valor da Moeda</th>
                    <th>Moeda Comprada</th>
                </tr>
                </thead>
                <tbody>
                    @forelse($historico as $historico)
                        <tr>
                            <td>{{ $historico->moeda_origem }}</td>
                            <td>{{ $historico->moeda_destino }}</td>
                            <td>R$ {{ number_format($historico->valor, 2, ',', '.') }}</td>
                            <td>{{ $historico->pagamento_tipo }}</td>
                            <td>R$ {{ number_format($historico->taxa_pagamento, 2, ',', '.') }}</td>
                            <td>R$ {{ number_format($historico->taxa_conversao, 2, ',', '.') }}</td>
                            <td>R$ {{ number_format($historico->valor_convertido, 2, ',', '.') }}</td>
                            <td>{{ $historico->valor_moeda }}</td>
                            <td>{{ $historico->moeda_comprada }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Nenhuma informação por enquanto.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
