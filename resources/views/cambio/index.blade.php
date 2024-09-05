@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h1>Câmbio Online:</h1>
                    <form action="" method="post">

                        @method('post')

                        <div>
                            <label class="form-label" for="moeda_origem">Moeda de origem</label>
                            <select class="form-select" id="moeda_origem" name="moeda_origem" disabled>
                                <option>BRL</option>
                            </select>
                        </div>

                        <div>
                            <label class="form-label" for="moeda_destino">Moeda de destino</label>
                            <select class="form-select" id="moeda_destino" name="moeda_destino" >
                                <option>USD - Dolar Americano</option>
                                <option>EUR - Euro</option>
                                <option>GBP - Libra Esterlina</option>
                            </select>
                        </div>

                        <div>
                            <label class="form-label" for="valor">Valor de compra</label>
                            <input class="form-control" id="valor" name="valor" type="number" />
                            <input class="w-100"  id="range" type="range" min="1000" max="100000" step="0.01" />
                        </div>

                        <div>
                            <label class="form-label" for="pagamento">Forma de pagamento</label>
                            <select class="form-select" id="pagamento" name="pagamento" >
                                <option>Boleto bancário</option>
                                <option>Cartão de crédito</option>
                            </select>
                        </div>


                    </form>
                </div>
                <div class="p-3">
                    <a class="btn btn-primary" href="{{ route('home') }}">Voltar</a>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
