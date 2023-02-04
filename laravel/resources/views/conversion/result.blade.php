@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Resultado da Cotação</div>

                    <div class="card-body">
                        <div class="row result">
                            <div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Moeda de origem:
                                        <strong>{{$response->currency_origin}}</strong></li>
                                    <li class="list-group-item">Moeda de destino:
                                        <strong>{{$response->currency_buy}}</strong></li>

                                    <li class="list-group-item">Valor para Conversão:
                                        <strong>@money($response->amount)</strong></li>
                                    <li class="list-group-item">Forma de pagamento:
                                        <strong>{{$response->payment_type}}</strong></li>
                                    <li class="list-group-item">Valor da "Moeda de destino" usado para conversão:
                                        <strong>@money($response->currency_value)</strong>
                                    </li>
                                    <li class="list-group-item">Valor comprado em "Moeda de destino":
                                        <strong>@money($response->value_bought)</strong>
                                    </li>
                                    <li class="list-group-item">Taxa de pagamento: <strong>@money($response->payment_tax)</strong>
                                    </li>
                                    <li class="list-group-item">Taxa de conversão: <strong>
                                            @money($response->conversion_tax)</strong>
                                    </li>
                                    <li class="list-group-item">Valor utilizado para conversão descontando as taxas:
                                        <strong>@money($response->conversion_value)</strong>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <hr>
                        <a href="{{route('form-conversion')}}" class="btn btn-warning" type="button">Voltar</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
