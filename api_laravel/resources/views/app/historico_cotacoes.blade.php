@extends('app.layout.base')

@section('conteudo')

 <section>
 	<div class="form-item">
 		<h2>Minhas cotações</h2>
        
        <div class="flex-table">

            <table style="width: 1200px">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Taxa Conversão</th>
                    <th>Taxa Pagamento</th>
                    <th>Valor Moeda Destino</th>
                    <th>Valor da Moeda de Compra</th>
                    <th>Total Conversão</th>
                    <th>Data da Cotação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cotacoes as $cotacao) 
                    <tr>
                        <td>{{ $cotacao->user->name }}</td>
                        <td>R$ {{ number_format($cotacao->taxa_conversao, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($cotacao->taxa_pagamento, 2, ',', '.') }}</td>
                        <td>R$ {{ $cotacao->moeda_destino }}</td>
                        <td>{{ $cotacao->moeda }} {{ number_format($cotacao->moedas_comprada, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($cotacao->total_conversao,2, ',', '.') }}</td>
                        <td>{{ $cotacao->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach 
            </tbody>
            </table>  

        </div>
 	</div>
 </section>



@endsection