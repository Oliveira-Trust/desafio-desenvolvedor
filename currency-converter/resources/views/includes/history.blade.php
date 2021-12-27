@extends('home')

@section('history')
    <div class="card mt-2">
        <div class="card-header"><h3 class="card-title">Histórico</h3></div>
        <div class="card-body">
            @if( isset($quotationData) )
                <div class="col-md-12">
                    <div class="card mt-1">
                        <div class="card-body">

                            <table class="table table-striped table-hover table-sm align-middle">
                                <tbody>
                                <tr>
                                    <td>Moeda de origem</td>
                                    <td><span>{{$quotationData['origin_currency']}}</span></td>
                                </tr>
                                <tr>
                                    <td>Moeda de destino</td>
                                    <td><span>{{$quotationData['destiny_currency']}}</span></td>
                                </tr>
                                <tr>
                                    <td>Valor para conversão</td>
                                    <td><span>R$ {{$quotationData['value_conversion']}}</span></td>
                                </tr>
                                <tr>
                                    <td>Forma de pagamento</td>
                                    <td><span>{{$quotationData['payment_method']}}</span></td>
                                </tr>
                                <tr>
                                    <td>Valor da "Moeda de destino" usado para conversão</td>
                                    <td><span>R$ {{$quotationData['destination_currency_value_for_conversion']}}</span></td>
                                </tr>
                                <tr>
                                    <td>Valor comprado em "Moeda de destino"</td>
                                    <td><span>R$ {{$quotationData['destination_currency_value_for_conversion']}}</span></td>
                                </tr>
                                <tr>
                                    <td>Taxa de pagamento</td>
                                    <td><span>R$ {{$quotationData['payment_rate']}}</span></td>
                                </tr>
                                <tr>
                                    <td>Taxa de conversão</td>
                                    <td><span>R$ {{$quotationData['conversion_rate']}}</span></td>
                                </tr>
                                <tr>
                                    <td>Valor utilizado para conversão descontando as taxas"</td>
                                    <td><span>R$ {{$quotationData['value_purchases_in_destination_currency']}}</span></td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
