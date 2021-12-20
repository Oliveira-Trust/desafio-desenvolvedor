<x-app-layout>
    <div class="container mx-auto px-4">
        <div class="w-full bg-white text-gray-800">
            <div class="mt-10">
                <h2 class="uppercase tracking-wider xs:text-sm lg:text-xl font-semibold border-l-4 border-yellow-400 pl-2 mt-5">Histórico de cotações</h2>
                <div class="mt-8 overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-100 text-gray-800 uppercase text-sm leading-normal">
                                <th class="py-3 px-1 md:px-6 text-left text-xs md:text-sm">Data</th>
                                <th class="py-3 px-1 md:px-6 text-left text-xs md:text-sm">Moeda</th>
                                <th class="py-3 px-1 md:px-6 text-left text-xs md:text-sm">Quantia</th>
                                <th class="py-3 px-1 md:px-6 text-center text-xs md:text-sm">Pagamento</th>
                                <th class="py-3 px-1 md:px-6 text-center text-xs md:text-sm">Taxas</th>
                                <th class="py-3 px-1 md:px-6 text-center text-xs md:text-sm">Você recebe</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @forelse ($currencyQuotes as $quote)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-2 px-2 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="mr-2">
                                            <svg class="w-6 h-6" fill="none" stroke="#119da4" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                        <span>{{ $quote['created_at'] }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-1 md:px-6 font-medium text-left">
                                    {{ $quote['currency_code'] }}
                                </td>
                                <td class="py-3 px-1 md:px-6 font-medium text-left">
                                    R$ {{ $quote['amount'] }}
                                </td>
                                <td class="py-3 px-1 md:px-6 font-medium text-center">
                                    {{ $quote['payment_method'] }}
                                </td>
                                <td class="py-3 px-1 md:px-6 font-medium text-center">
                                    R$ {{ $quote['tax'] }}
                                </td>
                                <td class="py-3 px-1 md:px-6 font-medium text-center">
                                    {{ $quote['final_amount'] }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="py-6 px-6 text-left">Faça sua primeira cotação.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-7">
                <a href="{{ route('home')}}"
                    class="mt-5 mb-2 px-4 py-2 bg-blue-400 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-400">Faça
                    uma cotação!</a>
            </div>
        </div>
    </div>

</x-app-layout>
