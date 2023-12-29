@extends('layouts.app')

@section('content')
    @if (Route::has('login'))
            @auth
                <div class="container-md">
                    <h1 class="title">Module: {!! config('coin.name') !!}</h1>
                    <hr>

                </div>
                <div class="container text-center">
                    <form enctype="multipart/form-data" action="{{ url('save') }}" method="post">
                        @csrf
                        <div class="row align-items-start">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="InputCoinValue" class="form-label ">Valor</label>
                                    <input type="coinValue" class="form-control form-control-lg" name="InputCoinValue" id="InputCoinValue" aria-describedby="InputCoinValue"/>
                                    <div id="InputCoinValue" class="form-text">Valor ao qual deseja calcular a conversão.</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="InputCoinValueDolar" class="form-label">Selecione a Moeda</label>
                                    <select class="form-control form-control-lg" name="selectCoin" id="selectCoin">
                                        <option>Selecione</option>
                                        @foreach($data as $option)
                                            <option value="{{ $option['high']  }}" prefix="{{ $option['code'] }}">{{ $option['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="selectedCurrency" id="selectedCurrency" value="">
                                    <div id="InputCoinValueDolar" class="form-text">Moedas disponíveis</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="fieldValorMoeda" class="form-label" id="valorMoeda">Valor da Moeda</label>
                                    <input type="text" class="form-control form-control-lg" name="fieldValorMoeda" id="fieldValorMoeda" aria-describedby="valorMoeda">
                                    <div id="DivValorMoeda" class="form-text">Valor da moeda selecionada</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="InputCoinValueConvert" class="form-label">Resultado</label>
                                    <input type="text" class="form-control form-control-lg" name="InputCoinValueConvert" id="InputCoinValueConvert" aria-describedby="InputCoinValueConvert">
                                    <div id="DivoinValueConvert" class="form-text">Resultado da conversão</div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-start">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="InputCoinValueBoleto" class="form-label ">Taxa do Boleto</label>
                                    <input type="text" class="form-control form-control-lg" name="InputCoinValueBoleto" id="InputCoinValueBoleto" aria-describedby="InputCoinValueBoleto"/>
                                    <div id="DivCoinValueBoleto" class="form-text">Valor para pagamento Boleto (1.45%)</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="InputCoinValueCt" class="form-label ">Taxa do Cartão de crédito</label>
                                    <input type="text" class="form-control form-control-lg" name="InputCoinValueCt" id="InputCoinValueCt" aria-describedby="InputCoinValueCt"/>
                                    <div id="DivCoinValueCt" class="form-text">Valor para pagamento com Cartão de crédito (7,63% )</div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-start">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="InputCoinValueFinalChoice" class="form-label ">Pagamento</label>
                                    <select class="form-control form-control-lg" name="selectPayment" id="selectPayment">
                                        <option>Selecione</option>
                                        <option value="boleto">Boleto</option>
                                        <option value="cartao">Cartão de Crédito</option>
                                    </select>
                                    <div id="DivCoinValueFinalChoice" class="form-text">Selecione como deseja efetuar o pagamento.</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="InputCoinValueFinalChoice" class="form-label ">Pagamento</label>
                                    <input type="text" class="form-control form-control-lg" name="InputCoinValueFinalChoice" id="InputCoinValueFinalChoice" aria-describedby="InputCoinValueFinalChoice"/>
                                    <div id="DivCoinValueFinalChoice" class="form-text"> Taxa de pagamento + Valor de Compra + Porcentagem por valor</div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-warning" role="alert">
                            Aplicar taxa de 2% pela conversão para valores abaixo de R$ 3.000,00 e 1% para valores maiores que R$ 3.000,00, essa taxa deve ser aplicada apenas no valor da compra e não sobre o valor já com a taxa de forma de pagamento.
                        </div>
                        <button type="submit" class="btn btn-primary" id="btn-submit" disabled="disabled">{{__('Salvar Cotação')}}</button>
                    </form>
                </div>
                </div>
            @else
                <div class="alert alert-warning container-sm" role="alert">
                    Você não esta logado
                </div>
            @endauth
        </div>
    @endif


@endsection
