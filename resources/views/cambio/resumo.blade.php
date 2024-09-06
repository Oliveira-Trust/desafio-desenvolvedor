@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Resumo') }}</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('cambio.enviaEmail') }}">
                            @csrf
                            @method('post')
                            <div class="mb-2">
                                <label class="form-label">Moeda de Origem:</label>
                                <input class="form-control" name="moeda_origem" value="{{ $moedaOrigem }}" readonly />
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Moeda de destino:</label>
                                <input class="form-control" name="moeda_destino" value="{{ $moedaDestino }}" readonly />
                            </div>
                            <div class="mb-2">
                                <label class="">Valor para conversão:</label>
                                <input class="form-control" name="valor_conversao" value="{{'R$ ' . $valor}}" readonly />
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Taxa de pagamento:</label>
                                <input class="form-control" name="taxa_pagamento" value="{{'R$ ' . number_format($taxaPagamento, 2)}}" readonly />
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Taxa de conversão:</label>
                                <input class="form-control" name="taxa_conversao" value="{{'R$ ' . number_format($taxaConversao, 2)}}" readonly />
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Valor para conversão - taxas:</label>
                                <input class="form-control" name="valor_compra" value="{{'R$ ' . number_format($valorCompra, 2)}}" readonly />
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Forma de pagamento:</label>
                                <input class="form-control" name="forma_pagamento" value="{{ $formaPagamento == 'CC' ? 'Cartão de Crédito' : 'Boleto Bancário' }}" readonly />
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Valor da moeda de destino:</label>
                                <input class="form-control" name="valor_moeda_destino" value="{{ number_format($bid, 2) . ' ' . $moedaDestino}}" readonly />
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Valor comprado:</label>
                                <input class="form-control" name="valor_comprado" value="{{ number_format($valorConvertido, 2) . ' ' . $moedaDestino }}" readonly />
                            </div>

                            <div class="d-flex align-items-center gap-2 mt-4">
{{--                                <input type="checkbox" name="enviar_email">--}}
{{--                                <label for="enviar_email">Enviar o resumo no meu e-mail</label>--}}
                            <p>OBS. Um resumo da operação será enviado ao seu e-mail cadastrado.</p>
                            </div>



                            <div class="mt-5 d-flex justify-content-between">
                                <a class="btn btn-danger" href="{{ route('cambio.index') }}">Refazer</a>
                                <button type="submit" class="btn btn-dark">Confirmar</button>
                            </div>
                        </form>

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
