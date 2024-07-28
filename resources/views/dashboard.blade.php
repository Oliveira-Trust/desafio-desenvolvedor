<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if(!isset($quotation))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Moeda
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Compra
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Venda
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Data/hora
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($apiQuotation))
                            @foreach($apiQuotation as $quotation)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $quotation->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                       R$ {{ \App\Helpers\format_decimal_string(($quotation->bid)) }}
                                    </td>
                                    <td class="px-6 py-4">
                                       R$ {{ \App\Helpers\format_decimal_string($quotation->ask) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ \App\Helpers\format_date_time($quotation->createDate) }}
                                    </td>
                                </tr>
                            @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                    @if(!isset($quotationResult))
                    <div class="relative overflow-x-auto mt-3">
                        <div class="mt-3 bg-gray-600 py-1 px-1 text-gray-100 sm:rounded">Faça sua cotação</div>
                        <form method="post" action="{{ route('quotation.store') }}">
                            @csrf
                            <div class="mt-3">
                                <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor em reais <span class="text-red-600">(mínimo R$ 1.000,00 - máximo R$ 100.000,00)</span> </label>
                                <div class="flex items-center">
                                    <span class="mr-2 text-gray-900 dark:text-white">R$</span>
                                    <input type="text" id="amount" name="conversion_amount" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg
                                        bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                            </div>
                            <div class="mt-3 flex gap-4">

                                <div class="flex-1">
                                    <label for="currency" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de moeda (moeda de origem/moeda de destino)</label>
                                    <select name="destination_currency" id="currency" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                                        focus:border-blue-500 block w-full p-2.5" required>
                                        <option selected value="">Escolha o tipo de moeda</option>
                                        @if(isset($apiQuotation))
                                        @foreach($apiQuotation as $quotation)
                                            <option value="{{ $quotation->code }}">{{ $quotation->name }}</option>
                                        @endforeach
                                        @endif


                                    </select>
                                </div>
                                <div class="flex-1">
                                    <label for="payment_method" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Forma de pagamento</label>
                                    <select name="payment_method_id" id="payment_method" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                                        rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                        <option selected value="">Escolha a forma de pagamento</option>
                                        @if(isset($paymentMethods))
                                        @foreach($paymentMethods as $method)
                                            <option value="{{ $method->id }}">{{ $method->method_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                    Cotação
                                </button>
                            </div>
                        </form>
                        <div>
                            @if(isset($errors))
                                @foreach($errors as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        @if(isset($quotationResult))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto">
                        <div class="overflow-hidden min-w-max">
                            <div class="grid grid-cols-1 p-4 text-sm font-medium text-gray-200 bg-blue-700 border-t border-b border-gray-200 gap-x-16 sm:rounded">
                                <div>COTAÇÃO</div>
                            </div>
                            <div class="grid grid-cols-3 p-4 text-sm font-medium text-gray-900 bg-gray-100 border-t border-b border-gray-200 gap-x-16">
                                <div>Nome: {{ $quotationResult->user->name }}</div>
                                <div>Email: {{ $quotationResult->user->email }}</div>
                                <div>data da cotação: {{ \App\Helpers\format_date_time($quotationResult->create_at) }}</div>
                            </div>
                            <div class="grid grid-cols-3 p-4 text-sm font-medium text-gray-900 bg-gray-100 border-t border-b border-gray-200 gap-x-16">
                                <div>Moeda de origem {{ $quotationResult->origin_currency }}</div>
                                <div>Moeda de destino {{ $quotationResult->destination_currency }}</div>
                                <div>Cotação: R$ {{ \App\Helpers\replace_dot_with_comma($quotationResult->quotation) }}</div>
                            </div>
                            <div class="grid grid-cols-3 p-4 text-sm font-medium text-gray-900 bg-gray-100 border-t border-b border-gray-200 gap-x-16">
                                <div>
                                    Forma de pagamento: {{ $quotationResult->paymentMethod->method_name }}
                                </div>
                                <div>
                                    Taxa de pagamento: R$ {{ \App\Helpers\format_float($quotationResult->payment_tax) }}
                                </div>
                                <div>
                                    Taxa de conversão: R$ {{ \App\Helpers\format_float($quotationResult->conversion_tax) }}
                                </div>
                            </div>
                            <div class="grid grid-cols-2 p-4 text-sm font-medium text-gray-900 bg-gray-100 border-t border-b border-gray-200 gap-x-16">
                                <div>
                                    Valor para conversão: R$ {{\App\Helpers\format_float($quotationResult->conversion_amount)}}
                                </div>
                                <div>
                                    Valor utilizado descontadas as taxas: R$ {{\App\Helpers\format_float($quotationResult->conversion_net_amount)}}
                                </div>
                            </div>
                            <div class="grid grid-cols-1 p-4 text-sm font-medium text-gray-200 bg-blue-700 border-t border-b border-gray-200 gap-x-16">
                                <div class="text-right">
                                    Total em {{ $quotationResult->destination_currency }} {{ \App\Helpers\format_float($quotationResult->destination_currency_available) }}
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            @endif

        @if(isset($quotationHistory))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto">
                        <div class="overflow-hidden min-w-max">
                            <div class="grid grid-cols-1 p-4 text-sm font-medium text-gray-900 bg-green-300 border-t border-b border-gray-200 gap-x-16 sm:rounded">
                                <div>Suas cotações</div>
                            </div>
                            <table class="min-w-full bg-gray-100 border border-gray-200">
                                <thead>
                                <tr>
                                    <th class="p-4 text-sm font-medium text-gray-900 border-b border-gray-200 text-left">Data</th>
                                    <th class="p-4 text-sm font-medium text-gray-900 border-b border-gray-200 text-left">Moeda</th>
                                    <th class="p-4 text-sm font-medium text-gray-900 border-b border-gray-200 text-left">Cotação</th>
                                    <th class="p-4 text-sm font-medium text-gray-900 border-b border-gray-200 text-left">Total para aquisição</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($quotationHistory as $history)
                                    <tr>
                                        <td class="p-4 text-sm font-medium text-gray-500 border-b border-gray-200">
                                            {{ \App\Helpers\format_date_time($history->created_at) }}
                                        </td>
                                        <td class="p-4 text-sm font-medium text-gray-500 border-b border-gray-200">
                                            {{ $history->destination_currency }}
                                        </td>
                                        <td class="p-4 text-sm font-medium text-gray-500 border-b border-gray-200">
                                            R$ {{ \App\Helpers\replace_dot_with_comma($history->quotation) }}
                                        </td>
                                        <td class="p-4 text-sm font-medium text-gray-500 border-b border-gray-200">
                                            {{ $history->destination_currency }} {{ \App\Helpers\format_float($history->destination_currency_available) }}
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
            @endif
    </div>
</x-app-layout>
