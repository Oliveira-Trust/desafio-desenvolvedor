@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Histórico de Cotações</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Data</th>
                <th>Moeda de Origem</th>
                <th>Moeda de Destino</th>
                <th>Valor</th>
                <th>Método de Pagamento</th>
                <th>Taxa de Câmbio</th>
                <th>Valor Convertido</th>
                <th>Taxa de Pagamento</th>
                <th>Taxa de Conversão</th>
            </tr>
        </thead>
        <tbody>
            @foreach($histories as $history)
            <tr>
                <td>{{ $history->created_at }}</td>
                <td>{{ $history->source_currency }}</td>
                <td>{{ $history->target_currency }}</td>
                <td>{{ $history->amount }}</td>
                <td>{{ $history->payment_method == 'boleto' ? 'Boleto' : 'Cartão de Crédito' }}</td>
                <td>{{ $history->exchange_rate }}</td>
                <td>{{ $history->converted_amount }}</td>
                <td>{{ $history->payment_fee }}</td>
                <td>{{ $history->conversion_fee }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
