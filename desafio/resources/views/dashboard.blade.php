<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <a href="{{route('moeda.formulario')}}"
               class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Nova Cotação</a>

            <div class="relative overflow-x-auto mt-4">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID Público</th>
                        <th scope="col" class="px-6 py-3">Quantia Original</th>
                        <th scope="col" class="px-6 py-3">Taxa de Pagamento</th>
                        <th scope="col" class="px-6 py-3">Taxa de Conversão</th>
                        <th scope="col" class="px-6 py-3">Total de Taxas</th>
                        <th scope="col" class="px-6 py-3">Quantia Final</th>
                        <th scope="col" class="px-6 py-3">Taxa de Câmbio</th>
                        <th scope="col" class="px-6 py-3">Quantia Convertida</th>
                        <th scope="col" class="px-6 py-3">Forma de Pagamento</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($histories as $history)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $history->public_id }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                R$ {{ number_format($history->valor, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                R$ {{ number_format($history->taxa_pagamento, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                R$ {{ number_format($history->taxa_conversao, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                R$ {{ number_format($history->taxas_totais, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                R$ {{ number_format($history->valor_final, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ number_format($history->taxa_cambio, 6, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                $ {{ number_format($history->valor_convertido, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ ucfirst(str_replace('_', ' ', $history->forma_pagamento)) }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{ $histories->links() }}
        </div>
    </div>
</x-app-layout>
