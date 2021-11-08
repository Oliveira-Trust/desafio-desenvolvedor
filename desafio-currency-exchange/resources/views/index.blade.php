@extends('masterpage')

@section('cabecalho')
    Cambio de Moedas
@endsection

@section('body')

    <form action="{{route ("enter_exchange")}}" method="post">
        @csrf
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"> Cambio de moedas</h4>
                <p class="card-description">Dados da transacao </p>
                <div class="form-group">
                    <label for="defautCurrency">Moeda Origem</label>
                    <input id="default" type="text" class="form-control" value="BRL"
                           placeholder="BRL" required disabled="true">
                </div>
                <div class="form-group">
                    <label for="defautCurrency">Tipo Conversao: </label>
                    <select class="form-control modal-select" id="current_purchased"
                            name="current_purchased">
                        <option class="select2-selection__placeholder" value="" selected>Selecione a moeda de de
                            conversao
                        </option>
                        <option value="USD">USD</option>
                        <option value="EUR">EUR</option>
                        <option value="BTC">BTC</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="valuePurchase">Valor a ser comprado: </label>
                    <input type="text" class="form-control" id="value_exchange" name="value_exchange"
                           placeholder="R$ 5000.00" required>
                </div>
                <div class="form-group">
                    <label for="defautCurrency">Tipo Conversao: </label>
                    <select class="form-control modal-select" id="type_payment"
                            name="type_payment">
                        <option class="select2-selection__placeholder" value="" selected>Selecione a forma de pagamento
                        </option>
                        <option value="CREDIT_CARD">Cartao de credito</option>
                        <option value="BANK_SLIP">Boleto Bancario</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Salvar</button>
    </form>
@endsection
