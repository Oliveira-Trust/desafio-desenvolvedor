@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3 class="card-title"></h3></div>
                <div class="card-body">
                    <form name="frm-convert" action="{{route('home')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="origin_currency">Moeda de origem:</label>
                                    <input style="cursor:not-allowed" type="text" readonly="readonly" class="form-control" name="origin_currency" id="origin_currency" value="BRL - Real Brasileiro"title="Real Brasileiro" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="destiny_currency">Moeda de destino:</label>
                                    <select id="destiny_currency" name="destiny_currency" class="form-select" style="width: 100%">
                                        <option value="">Selecione</option>
                                        @foreach($availablesCombinations as $key => $value)
                                            <option {{ old('destiny_currency') == $key ? 'selected="selected"' : '' }} value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="value_for_conversion">Valor para conversão:</label>
                                    <input type="text" value="{{old('value_for_conversion')}}" class="form-control" id="value_for_conversion" name="value_for_conversion" title="Valor para conversão" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="payment method">Forma de pagamento:</label>
                                    <select class="form-select" id="payment_method" name="payment_method" style="width: 100%">
                                        <option value="">Selecione</option>
                                        <option {{ old('payment_method') == 1 ? 'selected="selected"' : '' }} value="1">1. Boleto</option>
                                        <option {{ old('payment_method') == 2 ? 'selected="selected"' : '' }} value="2">2. Cartão de Crédito</option>
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        @if( count($quotationData) )
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3 class="card-title"></h3></div>
                    <div class="card-body">

                        <table class="table table-striped table-hover table-sm align-middle">
                            <tbody>
                            <tr>
                                <td>Moeda de origem</td>
                                <td><span>{{$quotationData['origin_currency']}}</span></td>
                            </tr>
                            <tr>
                                <td>Moeda de destino</td>
                                <td><span>{{$quotationData['destiny_currency']}}</span></td>
                            </tr>
                            <tr>
                                <td>Valor para conversão</td>
                                <td><span>R$ {{$quotationData['value_conversion']}}</span></td>
                            </tr>
                            <tr>
                                <td>Forma de pagamento</td>
                                <td><span>{{$quotationData['payment_method']}}</span></td>
                            </tr>
                            <tr>
                                <td>Valor da "Moeda de destino" usado para conversão</td>
                                <td><span>R$ {{$quotationData['destination_currency_value_for_conversion']}}</span></td>
                            </tr>
                            <tr>
                                <td>Valor comprado em "Moeda de destino"</td>
                                <td><span>R$ {{$quotationData['destination_currency_value_for_conversion']}}</span></td>
                            </tr>
                            <tr>
                                <td>Taxa de pagamento</td>
                                <td><span>R$ {{$quotationData['payment_rate']}}</span></td>
                            </tr>
                            <tr>
                                <td>Taxa de conversão</td>
                                <td><span>R$ {{$quotationData['conversion_rate']}}</span></td>
                            </tr>
                            <tr>
                                <td>Valor utilizado para conversão descontando as taxas"</td>
                                <td><span>R$ {{$quotationData['value_purchases_in_destination_currency']}}</span></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
