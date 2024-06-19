<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Conversor de Moedas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="currencyForm">
                        @csrf
                        <div class="form-group">
                            <label for="moeda_destino">Moeda de Destino:</label>
                            <select class="form-control" id="moeda_destino" name="moeda_destino" required>
                                <option value="" disabled selected>Selecione a Moeda</option>
                                <option value="USD">Dólar Americano (USD)</option>
                                <option value="EUR">Euro (EUR)</option>
                                <option value="GBP">Libra Esterlina (GBP)</option>
                                <!-- Adicione mais opções conforme necessário -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="valor">Valor para Conversão:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">BRL</span>
                                </div>
                                <input type="text" class="form-control" id="valor" name="valor" placeholder="Insira o valor" oninput="formatCurrency(this)" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="forma_pagamento">Forma de Pagamento:</label>
                            <select class="form-control" id="forma_pagamento" name="forma_pagamento" required>
                                <option value="" disabled selected>Selecione a Forma de Pagamento</option>
                                <option value="Boleto">Boleto</option>
                                <option value="Cartão de Crédito">Cartão de Crédito</option>
                            </select>
                        </div>

                        <button type="button" class="btn btn-primary" id="convertButton">Converter</button>
                    </form>
                    <div id="result" class="mt-4"></div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
