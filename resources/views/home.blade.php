@extends('layouts.master')

@section('h1', 'Conversão de Moedas')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Dados para Conversão</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Selecione uma moeda</label>
                <select class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Valor para Conversão</label>
                <input type="text" class="form-control money" placeholder="Insira um valor entre R$ 1.000,00 e R$ 100.000,00">
            </div>
            <div class="col-sm-6">
                <label for="">Forma de Pagamento</label>
                <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio">
                        <label for="customRadio1" class="custom-control-label">Boleto</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio">
                        <label for="customRadio2" class="custom-control-label">Cartão de Crédito</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-info">Consultar</button>
        </div>
    </div>
@endsection
