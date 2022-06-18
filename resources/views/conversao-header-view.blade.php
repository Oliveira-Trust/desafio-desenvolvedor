<style>
    .container {
        padding: 2em;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Conversor de Moedas') }}
        </h2>
    </x-slot>

    <div class="container" style="max-width: 90%">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-2">
                        <label for="valorInicial">Valor</label>
                        <input name="valorInicial" class="form-control" placeholder="0,00" style="text-align: right">
                    </div>
                    <div class="col-md-2">
                        <label for="moedaInicial">Converter De</label>
                        <select class="form-control" name="moedaInicial" readonly>
                            <option selected value="4">BRL</option>
                            <option value="41">USA</option>
                        </select>
                    </div>
                    <div class="col-md-1 align-self-end">
                        <div class="row justify-content-center">
                            <button disabled type="button" class="btn btn-lg" style="background: none;border:none">
                                <i class="bi bi-arrow-right" style="color: black;font-size: 1.5em"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="moedaDestino">Para</label>
                        <select class="form-control" name="moedaDestino" readonly>
                            <option selected value="4">BRL</option>
                            <option value="41">USA</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="tipoPagamento">Tipo de pagamento</label>
                        <select class="form-control" name="tipoPagamento" readonly>
                            <option selected value="3">Boleto</option>
                            <option value="41">Cartão de Crédito</option>
                        </select>
                    </div>
                    <div class="col-md-2 align-self-end">
                        <div class="row justify-content-center">
                            <button type="button" class="btn btn-primary btn-lg">
                                <span style="font-size:0.8em">Converter <i class="bi bi-arrow-clockwise"></i></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('conversao-body-view')
        @include('conversao-footer-view')
    </div>
</x-app-layout>
