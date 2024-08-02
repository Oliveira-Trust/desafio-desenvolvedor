<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes da Conversão') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @php
                    $symbol = 'R$ ';
                    switch ($conversion->to) {
                        case 'USD':
                            $symbol = '$ ';
                            break;
                        case 'EUR':
                            $symbol = '€ ';
                            break;
                        case 'GBP':
                            $symbol = '£ ';
                            break;
                        default:
                            break;
                    }
                @endphp
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <a href=" {{ route('conversion.conversion') }} " class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Nova Conversão
                        </a>
                    </div>
                    <div class="mb-4">
                        <label for="from" class="block text-sm font-medium text-gray-700">Moeda Origem</label>
                        <input type="text" id="from" value="{{ $conversion->from }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
                    </div>

                    <div class="mb-4">
                        <label for="to" class="block text-sm font-medium text-gray-700">Moeda Destino</label>
                        <input type="text" id="to" value="{{ $conversion->to }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
                    </div>

                    <div class="mb-4">
                        <label for="currency_value" class="block text-sm font-medium text-gray-700">Valor para conversão</label>
                        <input type="text" id="currency_value" value="R$ {{ number_format($conversion->amount, 2, ',', '.') }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
                    </div>

                    <div class="mb-4">
                        <label for="payment_method" class="block text-sm font-medium text-gray-700">Método de Pagamento</label>
                        <input type="text" id="payment_method" value="{{ $conversion->payment_method == 'boleto' ? 'Boleto' : 'Cartão de Crédito' }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
                    </div>

                    <div class="mb-4">
                        <label for="currency_value" class="block text-sm font-medium text-gray-700">Valor da Moeda de Conversão</label>
                        <input type="text" id="currency_value" value="{{ $symbol . number_format($conversion->currency_value, 2, ',', '.') }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
                    </div>

                    <div class="mb-4">
                        <label for="purchase_amount" class="block text-sm font-medium text-gray-700">Valor Comprado em Moeda de Conversão</label>
                        <input type="text" id="purchase_amount" value="{{ $symbol . number_format($conversion->purchase_amount, 2, ',', '.') }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
                    </div>


                    <div class="mb-4">
                        <label for="payment_rate" class="block text-sm font-medium text-gray-700">Taxa de Pagamento</label>
                        <input type="text" id="payment_rate" value="R$ {{ number_format($conversion->payment_rate, 2, ',', '.') }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
                    </div>

                    <div class="mb-4">
                        <label for="conversion_rate" class="block text-sm font-medium text-gray-700">Taxa de Conversão</label>
                        <input type="text" id="conversion_rate" value="R$ {{ number_format($conversion->conversion_rate, 2, ',', '.') }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
                    </div>

                    <div class="mb-4">
                        <label for="purchase_price_excluding_taxes" class="block text-sm font-medium text-gray-700">Valor Utilizado para Conversão sem as Taxas</label>
                        <input type="text" id="purchase_price_excluding_taxes" value="R$ {{ number_format($conversion->purchase_price_excluding_taxes, 2, ',', '.') }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
