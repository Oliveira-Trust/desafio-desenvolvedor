<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Exchange') }} | Conversor de moedas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="max-w-md">
                        <form method="post" action="{{ route('exchange.store') }}" class="space-y-6">
                            @csrf
                            @method('post')

                            <div>
                                <x-input-label for="target-currency" value="Moeda de origem" />
                                <x-text-input id="target-currency" name="target-currency" type="text"
                                    class="mt-1 block w-full !bg-gray-800" required value="BRL" readonly />
                            </div>
                            <div>
                                <x-input-label for="destination-currency" value="Moeda de destino" />
                                <select autofocus name="destination-currency" id="destination-currency"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    required>
                                    <option value="">Selecione a moeda</option>
                                    <option value="USD">USD - Dólar Americano</option>
                                    <option value="EUR">EUR - Euro</option>
                                    <option value="CNY">CNY - Yuan Chinês</option>
                                    <option value="JPY">JPY - Iene Japonês</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="amount" value="Valor" />
                                <x-text-input id="amount" name="amount" type="text" class="mt-1 block w-full"
                                    required autofocus />

                                <ul id="error-message" class="text-sm text-red-600 dark:text-red-400 space-y-1"
                                    style="display: none"></ul>
                            </div>
                            <div>
                                <x-input-label for="payment_method" value="Forma de pagamento" />
                                <select name="payment_method" id="payment_method"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    required>
                                    <option value="">Selecione a forma de pagamento</option>
                                    <option value="ticket">Boleto</option>
                                    <option value="credit_card">Cartão de crédito</option>
                                </select>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button id="convert-button"
                                    class="disabled:!bg-gray-400 disabled:cursor-not-allowed">{{ __('Converter') }}</x-primary-button>

                                @if (session('status') === 'exchange-added')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('Convertido com sucesso.') }}</p>
                                @endif
                            </div>
                        </form>
                    </div>

                    <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow-sm text-white">
                        @if (session('status') === 'exchange-added')
                            @php
                                $exchange = $exchanges->first();
                            @endphp

                            <div class="grid grid-cols-2 gap-6">
                                <div class="font-bold text-right pr-4">
                                    Moeda de origem:
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $exchange['origin_currency'] }}</p>
                                </div>

                                <div class="font-bold text-right pr-4">
                                    Moeda de destino:
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $exchange['destination_currency'] }}
                                    </p>
                                </div>

                                <div class="font-bold text-right pr-4">
                                    Valor para conversão:
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        R$ {{ number_format($exchange['amount'], 2, ',', '.') }}</p>
                                </div>

                                <div class="font-bold text-right pr-4">
                                    Forma de pagamento:
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        {{ $exchange['payment_method'] === 'ticket' ? 'Boleto' : 'Cartão de crédito' }}
                                    </p>
                                </div>

                                <div class="font-bold text-right pr-4">
                                    Valor da {{ $exchange['destination_currency'] }} usado para conversão:
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        $ {{ number_format($exchange['exchange_rate'], 2, ',', '.') }}</p>
                                </div>

                                <div class="font-bold text-right pr-4">
                                    Valor comprado em {{ $exchange['destination_currency'] }}:
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        $ {{ number_format($exchange['converted_amount'], 2, ',', '.') }}</p>
                                </div>

                                <div class="font-bold text-right pr-4">
                                    Taxa de pagamento:
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        R$ {{ number_format($exchange['payment_fee'], 2, ',', '.') }}</p>
                                </div>

                                <div class="font-bold text-right pr-4">
                                    Taxa de conversão:
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        R$ {{ number_format($exchange['conversion_fee'], 2, ',', '.') }}</p>
                                </div>

                                <div class="font-bold text-right pr-4">
                                    Valor utilizado para conversão descontando as taxas:
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        R$ {{ number_format($exchange['final_amount_for_conversion'], 2, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @else
                            <img src="{{ asset('images/default-image.png') }}" alt="Default Image"
                                class="w-full h-auto">
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-12 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Histórico de conversões
                    </h2>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="table-header">
                                <tr>
                                    <th class="table-header">Moeda de Origem</th>
                                    <th class="table-header">Moeda de Destino</th>
                                    <th class="table-header">Valor</th>
                                    <th class="table-header">Forma de Pagamento</th>
                                    <th class="table-header">Taxa de Câmbio</th>
                                    <th class="table-header">Valor Convertido</th>
                                    <th class="table-header">Taxa de Pagamento</th>
                                    <th class="table-header">Taxa de Conversão</th>
                                    <th class="table-header">Valor Final sem taxas</th>
                                    <th class="table-header">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($exchanges as $exchange)
                                    <tr>
                                        <td class="table-cell">{{ $exchange->origin_currency }}</td>
                                        <td class="table-cell">{{ $exchange->destination_currency }}</td>
                                        <td class="table-cell">{{ number_format($exchange->amount, 2, ',', '.') }}</td>
                                        <td class="table-cell">
                                            {{ $exchange->payment_method === 'ticket' ? 'Boleto' : 'Cartão de crédito' }}
                                        </td>
                                        <td class="table-cell">
                                            {{ number_format($exchange->exchange_rate, 2, ',', '.') }}</td>
                                        <td class="table-cell">
                                            {{ number_format($exchange->converted_amount, 2, ',', '.') }}</td>
                                        <td class="table-cell">{{ number_format($exchange->payment_fee, 2, ',', '.') }}
                                        </td>
                                        <td class="table-cell">
                                            {{ number_format($exchange->conversion_fee, 2, ',', '.') }}</td>
                                        <td class="table-cell">
                                            {{ number_format($exchange->final_amount_for_conversion, 2, ',', '.') }}
                                        </td>
                                        <td class="table-cell">
                                            <button id="menu-button-{{ $exchange->id }}"
                                                class="button-menu">•••</button>
                                            <div id="dropdown-menu-{{ $exchange->id }}" class="dropdown-menu hidden">
                                                <form action="{{ route('exchange.destroy', $exchange->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">Apagar</button>
                                                </form>
                                                <form action="{{ route('exchange.email', $exchange->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">Enviar por
                                                        email</button>
                                                </form>
                                            </div>
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
    </div>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#amount').mask('000.000.000.000.000,00', {
                reverse: true
            });

            $('#amount').on('input', function() {
                const amount = $(this).val().replace(/\./g, '').replace(',', '.');
                const errorMessage = $('#error-message');
                const convertButton = $('#convert-button');

                if (amount === '')
                    return errorMessage.hide();

                if (amount < 1000 || amount > 100000) {
                    errorMessage.text('O valor deve ser entre R$ 1.000,00 e R$ 100.000,00');
                    errorMessage.show();
                    convertButton.prop('disabled', true)
                } else {
                    errorMessage.hide();
                    convertButton.prop('disabled', false)
                }
            });

            $('.button-menu').on('click', function(event) {
                event.stopPropagation();

                $('.dropdown-menu').addClass('hidden');
                const menuId = $(this).attr('id').replace('menu-button-', 'dropdown-menu-');
                $('#' + menuId).toggleClass('hidden');
            });

            $(document).on('click', function(event) {
                if (!$(event.target).closest('.button-menu, .dropdown-menu').length) {
                    $('.dropdown-menu').addClass('hidden');
                }
            });
        });
    </script>
</x-app-layout>
