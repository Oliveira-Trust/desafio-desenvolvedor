@extends('layout.app')

@section('titulo', 'Histórico de Cotações')

@section('conteudo')

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Data/Hora</th>
                    <th>Moeda Origem</th>
                    <th>Moeda Destino</th>
                    <th>Forma Pagamento</th>
                    <th>Valor Solicitado</th>
                    <th>Tx Pagamento</th>
                    <th>Tx Conversão</th>
                    <th>Valor Convertido</th>
                </tr>
                </thead>
                <tbody>
                @foreach($conversoes as $conversao)
                    <tr>
                        <td align="center">{{$conversao->created_at}}</td>
                        <td align="center">{{$conversao->moeda_origem}}</td>
                        <td align="center">{{$conversao->moeda_destino}}</td>
                        <td align="center">{{$conversao->forma_pagamento}}</td>
                        <td align="right">{{number_format($conversao->valor_solicitado,2,',','.')}}</td>
                        <td align="right">{{number_format($conversao->taxa_pagamento,2,',','.')}}</td>
                        <td align="right">{{number_format($conversao->taxa_conversao,2,',','.')}}</td>
                        <td align="right">{{number_format($conversao->valor_convertido,2,',','.')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
