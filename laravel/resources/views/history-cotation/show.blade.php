@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Detalhes</div>

                    <div class="card-body">
                        <div class="row result">
                            <div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Moeda de origem:
                                        <strong>{{$history->currency_origin}}</strong></li>
                                    <li class="list-group-item">Moeda de destino:
                                        <strong>{{$history->currency_buy}}</strong></li>
                                    <li class="list-group-item">Valor para Conversão:
                                        <strong>@money($history->amount)</strong></li>
                                    <li class="list-group-item">Forma de pagamento:
                                        <strong>{{$history->payment_type}}</strong></li>
                                    <li class="list-group-item">Valor da "Moeda de destino" usado para conversão:
                                        <strong>@money($history->currency_value)</strong>
                                    </li>
                                    <li class="list-group-item">Valor comprado em "Moeda de destino":
                                        <strong>@money($history->value_bought)</strong>
                                    </li>
                                    <li class="list-group-item">Taxa de pagamento: <strong>@money($history->payment_tax)</strong>
                                    </li>
                                    <li class="list-group-item">Taxa de conversão: <strong>
                                            @money($history->conversion_tax)</strong>
                                    </li>
                                    <li class="list-group-item">Valor utilizado para conversão descontando as taxas:
                                        <strong>@money($history->conversion_value)</strong>
                                    </li>

                                    <li class="list-group-item">Data de Criação:
                                        <strong>{{$history->createdAt()}}</strong>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <hr>
                        <a href="{{route('history')}}" class="btn btn-warning" type="button">Voltar</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
