<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Histórico de Conversões') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($historicos->isEmpty())
                        <p>Nenhum histórico de conversão encontrado.</p>
                    @else
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Moeda Origem</th>
                                    <th class="px-4 py-2">Moeda Destino</th>
                                    <th class="px-4 py-2">Valor para Conversão</th>
                                    <th class="px-4 py-2">Forma de Pagamento</th>
                                    <th class="px-4 py-2">Valor da Moeda de destino</th>
                                    <th class="px-4 py-2">Valor Comprado</th>
                                    <th class="px-4 py-2">Taxa Pagamento</th>
                                    <th class="px-4 py-2">Taxa Conversão</th>
                                    <th class="px-4 py-2">Valor Utilizado para Conversão</th>
                                    <th class="px-4 py-2">Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historicos as $historico)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $historico->moeda_origem }}</td>
                                        <td class="border px-4 py-2">{{ $historico->moeda_destino }}</td>
                                        <td class="border px-4 py-2">{{ $historico->valor_para_conversao }}</td>
                                        <td class="border px-4 py-2">{{ $historico->forma_pagamento }}</td>
                                        <td class="border px-4 py-2">{{ $historico->bid_destino }}</td>
                                        <td class="border px-4 py-2">{{ $historico->valor_comprado }}</td>
                                        <td class="border px-4 py-2">{{ $historico->taxa_pagamento }}</td>
                                        <td class="border px-4 py-2">{{ $historico->taxa_conversao }}</td>
                                        <td class="border px-4 py-2">{{ $historico->valor_utilizado_para_conversao }}</td>
                                        <td class="border px-4 py-2">{{ $historico->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
