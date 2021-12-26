@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3 class="card-title"></h3></div>
                <div class="card-body">
                    <form name="" action="" method="POST">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="origin_currency">Moeda de origem:</label>
                                    <input style="cursor:not-allowed" type="text" readonly="readonly" class="form-control" id="origin_currency" value="BRL - Real Brasileiro"title="Real Brasileiro" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="destiny_currency">Moeda de destino:</label>
                                    <select id="destiny_currency" class="form-select" style="width: 100%">
                                        <option value="">Selecione</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="value_for_conversion">Valor para conversão:</label>
                                    <input type="text" class="form-control" id="value_for_conversion" title="Valor para conversão" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="payment method">Forma de pagamento:</label>
                                    <select class="form-select" id="payment method" style="width: 100%">
                                        <option value="">Selecione</option>
                                        <option value="1">1. Boleto</option>
                                        <option value="2">2. Cartão de Crédito</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 d-grid gap-2 mt-3">
                                <button id="btn-search-items" type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-search"></i>&nbsp;Converter
                                </button>
                            </div>
                        </div>
                        @error('manufactureCode')
                        <div class="error-label">
                            {{ $message }}
                        </div>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
