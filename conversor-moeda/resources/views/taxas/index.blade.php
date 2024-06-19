<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Taxas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-4">
                        <button type="button" class="btn btn-secondary" id="editButton">Editar</button>
                        <button type="button" class="btn btn-secondary" id="cancelButton" style="display: none;">Cancelar</button>
                    </div>
                    <div class="mt-4" id="editFormContainer" style="display: none;">
                        <form id="editarTaxasForm">
                            @csrf

                            @foreach ($taxas as $taxa => $row)
                                @if ($row['TAXA'] === 'BO')
                                <div class="form-group">
                                    <label for="boleto">Taxa de Boleto (%):</label>
                                    <input type="number" step="0.0001" class="form-control" id="boleto" name="boleto" placeholder="Insira a taxa de boleto" value="{{ $row['VALOR'] }}" required>
                                </div>
                                @elseif ($row['TAXA'] === 'CC')
                                <div class="form-group">
                                    <label for="cartao_credito">Taxa de Cartão de Crédito (%):</label>
                                    <input type="number" step="0.0001" class="form-control" id="cartao_credito" name="cartao_credito" placeholder="Insira a taxa de cartão de crédito" value="{{ $row['VALOR'] }}" required>
                                </div>
                                @elseif ($row['TAXA'] === 'CMA')
                                <div class="form-group">
                                    <label for="conversao_maior_3000">Taxa de Conversão Maior que 3 mil (%):</label>
                                    <input type="number" step="0.0001" class="form-control" id="conversao_maior_3000" name="conversao_maior_3000" placeholder="Insira a taxa de conversão maior que 3 mil" value="{{ $row['VALOR'] }}" required>
                                </div>
                                @elseif ($row['TAXA'] === 'CME')
                                <div class="form-group">
                                    <label for="conversao_menor_3000">Taxa de Conversão Menor que 3 mil (%):</label>
                                    <input type="number" step="0.0001" class="form-control" id="conversao_menor_3000" name="conversao_menor_3000" placeholder="Insira a taxa de conversão menor que 3 mil" value="{{ $row['VALOR'] }}" required>
                                </div>
                                @endif
                            @endforeach
                            <button type="button" class="btn btn-primary" id="saveButton">Salvar</button>
                        </form>
                    </div>

                    <div class="mt-4" id="taxaTableContainer">
                        <h4>Taxas Atuais</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Valor (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($taxas as $taxa => $row)
                                <tr data-taxa="{{ $row['TAXA'] }}">
                                    <td>{{ $row['DESC_TAXA'] }}</td>
                                    <td class="taxa-valor">{{ $row['VALOR'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="result" class="mt-4"></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
