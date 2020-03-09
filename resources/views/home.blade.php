@extends('layouts.app')

@section('content')
<div class="container">
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
            <div class="card " style="height:500px;">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>Bem vindo, {{auth()->user()->name}}</h3>
                    <br/>
                    <div id="canvas-holder" style="width:60%;">
                            <canvas id="chart-area"></canvas>
                        </div>

                        <script>
                            var randomScalingFactor = function() {
                                return Math.round(Math.random() * 100);
                            };


                            var config = {
                                type: 'pie',
                                data: {
                                    datasets: [{
                                        data: [
                                            {{$typing}},
                                            {{$awaitingPayment}},
                                            {{$paymentConfirmed}},
                                            {{$cancelled}},
                                        ],
                                        backgroundColor: [
                                        'Blue',
                                        'Green',
                                        'Orange',
                                        'Red',
                                        ],
                                        label: 'Dataset 1'
                                    }],
                                    labels: [
                                        'Em Digitação',
                                        'Aguardando Pagamento',
                                        'Pagamento Confirmado',
                                        'Cancelado',
                                    ]
                                },
                                options: {
                                    responsive: true
                                }
                            };

                            window.onload = function() {
                                var ctx = document.getElementById('chart-area').getContext('2d');
                                window.myPie = new Chart(ctx, config);
                            };
                        </script>

                </div>
            </div>
        </div>

@endsection
