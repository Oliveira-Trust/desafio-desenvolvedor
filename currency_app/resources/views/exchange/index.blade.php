<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Conversões
        </h2>
    </x-slot>


    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <a href="{{ route('user-history.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Nova conversão
                </a>
            </div>

            <div class="mt-7 bg-white p-6">
                <div class="bg-white border-b border-gray-200">
                    <div class="border-b border-gray-200 shadow">
                        <div class="overflow-x-auto">
                            <table class="w-full whitespace-nowrap">
                                <thead class="bg-gray-800">
                                    <tr>
                                        <th class="px-6 py-2 text-xs text-white">
                                            MOEDA (ORIGEM)
                                        </th>
                                        <th class="px-6 py-2 text-xs text-white">
                                            MOEDA (DESTINO)
                                        </th>
                                        <th class="px-6 py-2 text-xs text-white">
                                            VALOR PARA CONVERSÃO
                                        </th>
                                        <th class="px-6 py-2 text-xs text-white">
                                            FORMA DE PAGAMENTO
                                        </th>
                                        <th class="px-6 py-2 text-xs text-white">
                                            VALOR DA MOEDA (DESTINO)
                                        </th>
                                        <th class="px-6 py-2 text-xs text-white">
                                            VALOR CONVERTIDO
                                        </th>
                                        <th class="px-6 py-2 text-xs text-white">
                                            TAXA (FORMA DE PAGAMENTO)text-white
                                        </th>
                                        <th class="px-6 py-2 text-xs text-white">
                                            TAXA (DE CONVERSÃO)
                                        </th>
                                        <th class="px-6 py-2 text-xs text-white">
                                            VALOR DESCONTADO
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @forelse ($histories as $history)
                                        <tr class="whitespace-nowrap">
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                {{ $history->origin_currency }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                {{ $history->destination_currency }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                {{ $history->value }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                {{ $history->payment_method }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                {{ $history->destination_currency_price }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                {{ $history->selling_price }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                {{ $history->payment_method_fee }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                {{ $history->convertion_fee }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                {{ $history->discounted_value }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="whitespace-nowrap" colspan="9">
                                            <td class="px-6 py-4 text-sm text-gray-500" colspan="9">
                                                Nenhuma compra realizada até o momento
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
