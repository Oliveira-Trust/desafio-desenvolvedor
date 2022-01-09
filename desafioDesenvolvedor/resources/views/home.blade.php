@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <form action="">
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">BRL</div>
                                </div>
                                <input type="text" class="form-control " id="brl_value" placeholder="entre R$ 1.000,00 ~ R$ 100.000,00">
                                <div id="validation_range_value" class="invalid-feedback">

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Moeda de destino:</label>
                            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                <option selected>Choose...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Forma de pagamento:</label>
                            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                <option value="1" selected>Boleto</option>
                                <option value="2">Cartão de Crédito</option>                                <
                            </select>
                            <small id="passwordHelpBlock" class="form-text text-muted">
                                Para pagamentos em boleto, taxa de 1,45%* <br>
                                Para pagamentos em cartão de crédito, taxa de 7,63%*
                            </small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
