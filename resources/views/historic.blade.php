@extends('layouts.main')

@section('content')
<div class="container" id="app">
    <div class="row mt-5">
        <div class="col-12">
            <table class="table table-striped">
                <tr>
                    <th>Valor para conversão</th>
                    <th>Moeda origem</th>
                    <th>Moeda destino </th>
                    <th>Valor com descontos</th>
                    <th>Forma de pagamento</th>
                    <th>Valor convertido</th>
                </tr>
                @forelse ($historics as $historic)
                    <tr>
                        <td>{{ number_format( $historic->value, 2, ',', '.' ) }}</td>
                        <td>{{ $historic->origin_coin }}</td>
                        <td>{{ $historic->destination_coin }}</td>
                        <td>{{ number_format( $historic->value_with_discount, 2, ',', '.' ) }}</td>
                        <td>{{ $historic->payment_method }}</td>
                        <td>{{ number_format( $historic->value_buy, 2, ',', '.' ) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td>Não existe historico para esse usuário</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>

@endsection
