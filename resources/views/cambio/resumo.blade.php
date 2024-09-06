@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Resumo') }}</div>

                    <div class="card-body">
                        <div class="d-flex">
                            <h5 class="">Moeda de Origem:</h5>
                            <p>&nbsp;{{ $moedaOrigem }}</p>
                        </div>
                        <div class="d-flex">
                            <h5 class="">Moeda de destino:</h5>
                            <p>&nbsp;{{ $moedaDestino }}</p>
                        </div>
                        <div class="d-flex">
                            <h5 class="">Valor para conversão:</h5>
                            <p>&nbsp; {{ $valor }}</p>
                        </div>
                        <div class="d-flex">
                            <h5 class="">Taxa de pagamento:</h5>
                            <p>&nbsp;0</p>
                        </div>
                        <div class="d-flex">
                            <h5 class="">Taxa de conversão:</h5>
                            <p>&nbsp; {{ $taxa }}</p>
                        </div>
                        <div class="d-flex">
                            <h5 class="">Valor para conversão - taxas:</h5>
                            <p>&nbsp;{{ $valorCompra }}</p>
                        </div>
                        <div class="d-flex">
                            <h5 class="">Forma de pagamento:</h5>
                            <p>&nbsp; {{ $formaPagamento = 'CC' ? 'Cartão de Crédito' : 'Boleto Bancário' }}</p>
                        </div>
                        <div class="d-flex">
                            <h5 class="">Valor da moeda de destino:</h5>
                            <p>&nbsp; {{ $bid }}</p>
                        </div>
                        <div class="d-flex">
                            <h5 class="">Valor comprado:</h5>
                            <p>&nbsp; {{ $valorConvertido }}</p>
                        </div>


                    </div>
                    <div class="p-3 d-flex justify-content-between">
                        <a class="btn btn-danger" href="{{ route('cambio.index') }}">Refazer</a>
                        <a class="btn btn-dark">Confirmar</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="{{asset('assets/js/cambio.js')}}"></script>
@endsection
