@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Painel Administrativo') }}</div>

                    <div class="card-body">
                        <form action="{{ route('cambio.consultaAPI') }}" method="post">
                            @csrf
                            @method('post')

                            <div class="mb-2">
                                <label class="form-label" for="moeda_origem">Moeda de origem</label>
                                <select class="form-control" id="moeda_origem" name="moeda_origem">
                                    <option selected value="BRL">BRL - Real Brasileiro</option>
                                </select>
                            </div>

                            <div class="mb-2">
                                <label class="form-label" id="taxa_conversao_abaixo" for="taxa_conversao_abaixo">Taxa de conversão (Abaixo de R$3000) </label>
                                <input class="form-control" id="taxa_conversao_abaixo" name="taxa_conversao_abaixo" />
                            </div>

                            <div class="mb-2">
                                <label class="form-label" id="taxa_pagamento_boleto" for="taxa_pagamento_boleto">Taxa de pagamento (Boleto Bancário) </label>
                                <input class="form-control" id="taxa_pagamento_boleto" name="taxa_pagamento_boleto" />
                            </div>

                            <div class="mb-2">
                                <label class="form-label" id="taxa_pagamento_cartao" for="taxa_pagamento_cartao">Taxa de pagamento (Cartão de Crédito) </label>
                                <input class="form-control" id="taxa_pagamento_cartao" name="taxa_pagamento_cartao" />
                            </div>

                            <div class="pt-5 d-flex justify-content-between">
                                <div>
                                    <a class="btn btn-danger" href="{{ route('home') }}">Voltar</a>
                                </div>
                                <div>
                                    <a id="limpar_campos" class="btn btn-secondary">Limpar</a>
                                    <button class="btn btn-dark" type="submit">Cotar</button>
                                </div>
                            </div>
                        </form>

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
