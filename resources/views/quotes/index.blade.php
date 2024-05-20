<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cotações') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="max-w-screen-xl mx-auto px-4 md:px-8">

                        <div class="items-start justify-between md:flex">
                            <div class="max-w-lg">
                                <h3 class="text-gray-800 text-xl font-bold sm:text-2xl">Histórico</h3>

                            </div>
                            <div class="mt-3 md:mt-0">
                                <a href="{{ route('quotes.create') }}"
                                    class="inline-block px-4 py-2 text-white duration-150 font-medium bg-indigo-600 rounded-lg hover:bg-indigo-500 active:bg-indigo-700 md:text-sm">Nova
                                    cotação</a>
                            </div>
                        </div>
                        <div class="mt-12 relative h-max overflow-auto">
                            <table class="w-full table-auto text-sm text-left">
                                <thead class="text-gray-600 font-medium border-b">
                                    <tr>
                                        <th class="py-3 pr-6">Nº</th>
                                        <th class="py-3 pr-6">Moeda de destino / Moeda de origem</th>
                                        <th class="py-3 pr-6">Data</th>
                                        <th class="py-3 pr-6">Meio de Pagamento</th>
                                        <th class="py-3 pr-6">Valor para conversão</th>
                                        <th class="py-3 pr-6">Cotação</th>
                                        <th class="py-3 pr-6">Valor Convertido</th>
                                        <th class="py-3 pr-6"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 divide-y">
                                    @foreach ($quotes as $quote)
                                        <tr>
                                            <td class="pr-6 py-4 whitespace-nowrap">{{ $quote->id }}</td>
                                            <td class="pr-6 py-4 whitespace-nowrap">{{ $quote->name }}</td>
                                            <td class="pr-6 py-4 whitespace-nowrap">
                                                {{ Carbon\Carbon::parse($quote->created_at)->format('d/m/Y') }}</td>
                                            <td class="pr-6 py-4 whitespace-nowrap">
                                                {{ $paymentMethods[$quote->payment_method] }}</td>
                                            <td class="pr-6 py-4 whitespace-nowrap">{{ $quote->conversion_amount }}</td>
                                            <td class="pr-6 py-4 whitespace-nowrap">{{ $quote->currency_value }}</td>
                                            <td class="pr-6 py-4 whitespace-nowrap">{{ $quote->converted_amount }}</td>
                                            <td class="text-right whitespace-nowrap">
                                                <a href="{{ route('quotes.show', ['quote' => $quote]) }}"
                                                    class="py-1.5 px-3 text-gray-600 hover:text-gray-500 duration-150 hover:bg-gray-50 border rounded-lg">Ver</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
