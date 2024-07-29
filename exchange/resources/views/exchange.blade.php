<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Exchange') }} | Conversor de moedas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
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
        });
    </script>
</x-app-layout>
