@extends('layout.app')

@section('titulo', 'Resultado da Conversão')

@section('conteudo')

    <div class="card">
        <div class="card-body">
            <a href="{{ route('conversao.index') }}" class="btn btn-primary mb-2">Nova Conversão</a>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td width="15%" class="text-bold">Moeda de origem:</td>
                    <td>{{$calculo->moeda_origem}}</td>
                </tr>
                <tr>
                    <td width="15%" class="text-bold">Moeda de destino:</td>
                    <td>{{$calculo->moeda_destino}}</td>
                </tr>
                <tr>
                    <td width="15%" class="text-bold">Valor para conversão:</td>
                    <td>{{ number_format($calculo->valor_solicitado,2,',','.') }}</td>
                </tr>
                <tr>
                    <td width="15%" class="text-bold">Forma de pagamento:</td>
                    <td>{{ $calculo->forma_pagamento }}</td>
                </tr>
                <tr>
                    <td width="15%" class="text-bold">Valor da "Moeda de destino" usado para conversão:</td>
                    <td>{{ number_format($calculo->cotacao_moeda_destino,2,',','.') }}</td>
                </tr>
                <tr>
                    <td width="15%" class="text-bold">Valor comprado em "Moeda de destino":</td>
                    <td>{{ number_format($calculo->valor_convertido,2,',','.') }}</td>
                </tr>
                <tr>
                    <td width="15%" class="text-bold">Taxa de pagamento:</td>
                    <td>{{ number_format($calculo->taxa_pagamento,2,',','.') }}</td>
                </tr>
                <tr>
                    <td width="15%" class="text-bold">Taxa de conversão:</td>
                    <td>{{ number_format($calculo->taxa_conversao,2,',','.') }}</td>
                </tr>
                <tr>
                    <td width="15%" class="text-bold">Valor utilizado para conversão descontando as taxas:</td>
                    <td>{{ number_format(($calculo->valor_solicitado - $calculo->taxa_pagamento - $calculo->taxa_conversao) ,2,',','.') }}</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>

@endsection
