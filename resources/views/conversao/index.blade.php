@extends('layout.app')

@section('titulo', 'Conversão')

@section('conteudo')
    @if (Session::has('alert-warning'))
        <div class="alert alert-warning">
            {{ Session::get('alert-warning') }}
        </div>
    @endif
    <form action="{{ route('conversao.calcula') }}" method="post" class="form-horizontal">

        <div class="card">
            <div class="card-body">
                @csrf

                <div class="form-group row">
                    <label for="moeda_origem" class="col-md-2 col-form-label">Moeda Origem</label>
                    <div class="col-md-2">
                        <select name="moeda_origem" id="moeda_origem" class="form-control" readonly="">
                            <option>BRL</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="moeda_destino" class="col-md-2 col-form-label">Moeda Destino</label>
                    <div class="col-md-2">
                        <select name="moeda_destino" id="moeda_destino" class="form-control" required>
                            <option value=""></option>
                            <option>USD</option>
                            <option>BTC</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="valor_conversao" class="col-md-2 col-form-label">Valor para conversão</label>
                    <div class="col-md-2">
                        <input type="text" name="valor_conversao" id="valor_conversao" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="forma_pagamento" class="col-md-2 col-form-label">Forma de Pagamento</label>
                    <div class="col-md-2">
                        <select name="forma_pagamento" id="forma_pagamento" class="form-control" required>
                            <option value=""></option>
                            <option value="Boleto">Boleto</option>
                            <option value="Cartao">Cartão de Crédito</option>
                        </select>
                    </div>
                </div>


            </div>
            <div class="card-footer">
                <div class="col-md-2 offset-md-2">
                    <button type="submit" class="btn btn-primary">Calcular</button>
                </div>

            </div>
        </div>
    </form>

@endsection
