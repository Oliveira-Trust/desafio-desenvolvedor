<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Realizar Conversão') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="conversion-form" action="/convert" method="GET">
                        <div class="mb-4">
                            <label for="from" class="block text-sm font-medium text-gray-700">Moeda Origem</label>
                            <select id="from" name="from" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                <option value="BRL">Real Brasileiro</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="to" class="block text-sm font-medium text-gray-700">Moeda Destino</label>
                            <select id="to" name="to" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                <option value="USD">Dólar Americano</option>
                                <option value="EUR">Euro</option>
                                <option value="GBP">Libra Esterlina</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="amount" class="block text-sm font-medium text-gray-700">Valor para conversão</label>
                            <input type="number" id="amount" name="amount" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" min="1000" max="100000" required>
                        </div>

                        <div class="mb-4">
                            <label for="payment_method" class="block text-sm font-medium text-gray-700">Método de pagamento</label>
                            <select id="payment_method" name="payment_method" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                <option value="boleto">Boleto</option>
                                <option value="credit_card">Cartão de Crédito</option>
                            </select>
                        </div>
                        <x-primary-button type="submit">
                            Converter valor
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
