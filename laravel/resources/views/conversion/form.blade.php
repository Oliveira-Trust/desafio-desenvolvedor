@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Cotação de Moedas</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{route('post-conversion')}}" method="POST" enctype="multipart/form-data"
                              id="form">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Moeda Origem:</strong>
                                        <select name="currency_origin" id="currency_origin" class="form-control" required>
                                            <option value="BRL" selected>Real Brasileiro</option>
                                        </select>
                                        @error('currency_origin')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Moeda de Compra:</strong>
                                        <select name="currency_buy" id="currency_buy" class="form-control" required>
                                            <option selected disabled>Selecione</option>
                                            <option value="USD">Dólar Americano</option>
                                            <option value="AUD">Dólar Australiano</option>
                                            <option value="CAD">Dólar Canadense</option>
                                            <option value="EUR">Euro</option>
                                            <option value="GBP">Libra Esterlina</option>
                                            <option value="ARS">Peso Argentino</option>
                                        </select>
                                        @error('currency_buy')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Valor para Conversão:</strong>
                                        <input type="text" name="amount" id="amount" class="form-control"
                                               placeholder="Valor para Conversão" value="{{old('amount')}}"
                                               required>
                                        @error('amount')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Forma de Pagamento:</strong>
                                        <select name="payment_type" id="" class="form-control" required>
                                            <option selected disabled>Selecione</option>
                                            <option value="boleto">Boleto</option>
                                            <option value="credit_card">Cartão de Crédito</option>

                                        </select>
                                        @error('payment_type')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary col-sm-2  pl-2 mt-4 ">Enviar</button>
                                    <a href="{{route('home')}}" class="btn btn-secondary col-sm-2 ml-2 pl-3 mt-4 ">Voltar
                                    </a>

                                </div>
                                </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
