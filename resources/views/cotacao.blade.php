@extends('template.template')

@section('title','Adson Conversor - Cotacao')

@section('content')
    <div class="album text-muted">
        <div class="container">
            <div class="row">
                <div class="card cardConversor">
                    <div class="card-body">
                        <i class="far fa-money-bill-alt" title=""></i>
                        <h5 class="card-title">Resultado Detalhado</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Moeda de origem:&ensp; <b>{{$dados->padrao}}</b></li>
                            <li class="list-group-item">Moeda de destino:&ensp; <b>{{$dados->liberada}}</b> </li>
                            <li class="list-group-item">Valor para conversão:&ensp; <b>R$: {{$dados->valor_compra}} </b></li>
                            <li class="list-group-item">Forma de pagamento:&ensp;<b>{{$dados->forma_pagamento}}</b> </li>
                            <li class="list-group-item">Valor do "{{$dados->liberada}}" usado para conversão:&ensp; <b> R$:{{$dados->valor_moeda_liberada}}</b></li>
                            <li class="list-group-item">Valor comprado em "{{$dados->liberada}}":&ensp; <b>{{$dados->simbolo}}: {{$dados->valorConvertido}} </b></li>
                            <li class="list-group-item">Taxa de pagamento:&ensp; <b>R$: {{$dados->valorTaxaPagamento}} </b></li>
                            <li class="list-group-item">Taxa de conversão:&ensp; <b>R$: {{$dados->valorTaxaConversao}} </b></li>
                            <li class="list-group-item">Valor utilizado para conversão descontando as taxas:&ensp; <b>R$: {{$dados->valorConversao}} </b></li>


                        </ul>

                        <div class="row">

                            <div class="col-md">
                                <div class="divresultado">
                                    Valor final: <span class="badge badge-success">{{$dados->simbolo}} {{$dados->valorConvertido}}</span>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md">
                                <div class="">
                                    <ul class="nav justify-content-center">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#"><i class="fas fa-envelope-open-text"></i>
                                                Enviar por E-mail</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/"><i class="fas fa-redo"></i>

                                                Refazer</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>

            </div>


        </div>
    </div>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" type="text/javascript"></script>

    <script>

        function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };

        $(document).ready(function(){
            $(document).on("keydown", disableF5);
        });

    </script>
@endsection
