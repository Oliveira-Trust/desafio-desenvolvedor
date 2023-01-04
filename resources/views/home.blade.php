@extends('layouts.master')

@section('h1', 'Conversão de Moedas')

@section('content')
    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> Opa!</h5>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Dados para Conversão</h3>
        </div>
        <form action="{{ route('conversor') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Selecione uma moeda</label>
                    <select name="moeda" class="form-control">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Valor para Conversão</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                        </div>
                        <input type="text" class="form-control money" name="valor" placeholder="Insira um valor entre R$ 1.000 e R$ 100.000" value="{{ old('valor') }}">
                        <div class="input-group-append">
                            <span class="input-group-text">,00</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="">Forma de Pagamento</label>
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="boleto" name="pagamento" value="boleto" {{ old('pagamento') === 'boleto' ? 'checked' : '' }}>
                            <label for="boleto" class="custom-control-label">Boleto</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="cartao" name="pagamento" value="cartao" {{ old('pagamento') === 'cartao' ? 'checked' : '' }}>
                            <label for="cartao" class="custom-control-label">Cartão de Crédito</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-info">Consultar</button>
            </div>
        </form>
    </div>
@endsection
