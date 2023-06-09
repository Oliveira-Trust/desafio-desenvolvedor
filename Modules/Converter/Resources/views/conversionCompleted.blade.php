@extends('layouts.common.main')

@section('title', 'Conversão Finalizada')

@section('content')
    <div class="col-md-6">
        <h1 class="text-center">Conversão Finalizada</h1>

        <table>
            <table>
                <tr>
                    <th>Descrição</th>
                    <th>Valor</th>
                </tr>
                <tr>
                    <td>Moeda de origem</td>
                    <td>BRL</td>
                </tr>
                <tr>
                    <td>Moeda de destino</td>
                    <td>{{$conversion->destination_currency}}</td>
                </tr>
                <tr>
                    <td>Valor para conversão</td>
                    <td>{{$conversion->value_to_convert}}</td>
                </tr>
                <tr>
                    <td>Forma de pagamento</td>
                    <td>{{$conversion->payment_method}}</td>
                </tr>
                <tr>
                    <td>Valor da Moeda de destino </td>
                    <td>{{$conversion->destination_currency_value}}</td>
                </tr>
                <tr>
                    <td>Valor comprado em "Moeda de destino"</td>
                    <td>{{$conversion->purchase_value}}</td>
                </tr>
                <tr>
                    <td>Taxa de pagamento</td>
                    <td>{{$conversion->payment_fee}}</td>
                </tr>
                <tr>
                    <td>Taxa de conversão</td>
                    <td>{{$conversion->conversion_fee}}</td>
                </tr>
                <tr>
                    <td>Valor utilizado para conversão</td>
                    <td>{{$conversion->final_conversion_value}}</td>
                </tr>
            </table>
        </table>

    </div>
@endsection
