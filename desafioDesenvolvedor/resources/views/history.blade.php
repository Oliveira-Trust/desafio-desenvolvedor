@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">valor informado</th>
                        <th scope="col">tipo de pagamento</th>
                        <th scope="col">nome</th>
                        <th scope="col">cotação</th>
                        <th scope="col">data</th>
                        <th scope="col">resultado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stockHistory as $history)
                    <tr>
                        <th scope="row">{{ $history->id }}</th>
                        <td>{{ $history->currency_from }}</td>
                        <td>{{ $history->payment_type == 1 ? 'Boleto' : 'Cartão de Crédito' }}</td>
                        <td>[{{ $history->currency_to }}] - {{ $history->name }}</td>
                        <td>{{ $history->bid }}</td>
                        <td>{{ $history->create_date }}</td>
                        <td>{{ $history->quote_value }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
