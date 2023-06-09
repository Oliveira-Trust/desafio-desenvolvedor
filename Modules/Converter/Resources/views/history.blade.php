@extends('layouts.common.main')

@section('title', 'Histórico de Conversões')

@section('content')
    <div class="col-md-6">
        <h1 class="text-center">Histórico de Conversões</h1>


        <table class="table table-bordered">
            <tr>
                <th>Moeda de Destino</th>
                <th>Valor</th>
                <th>Data</th>
                <th>Detalhes</th>
            </tr>
            @foreach ($conversionHistories as $conversion)
                <tr>
                    <td>{{ $conversion->destination_currency }}</td>
                    <td>{{ $conversion->value_to_convert }}</td>
                    <td>{{ $conversion->created_at }}</td>
                    <td><a
                            href="{{ route('converter.result', ['conversionHistoryResultId' => $conversion->id]) }}">Visualizar</a>
                    </td>
                </tr>
            @endforeach
        </table>


    </div>
@endsection
