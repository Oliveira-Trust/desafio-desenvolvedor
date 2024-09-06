@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header p-3"><h5>{{ __('Cotação de câmbio online') }}</h5></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
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
                            <label class="form-label" for="moeda_destino">Moeda de destino</label>
                            <select class="form-select" id="moeda_destino" name="moeda_destino">
                                <option selected value="">Selecione</option>
                                <option value="USD">USD - Dolar Americano</option>
                                <option value="EUR">EUR - Euro</option>
                                <option value="GBP">GBP - Libra Esterlina</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label" id="valor_label" for="valor">Valor de compra em </label>
                            <input class="form-control money" id="valor" name="valor" />
                            <input class="w-100"  id="range" type="range" min="1000" max="100000" value="1000" step="0.01" />
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="pagamento">Forma de pagamento</label>
                            <select class="form-select" id="pagamento" name="pagamento" >
                                <option selected value="">Selecione</option>
                                <option value="BB">Boleto bancário</option>
                                <option value="CC">Cartão de crédito</option>
                            </select>
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
