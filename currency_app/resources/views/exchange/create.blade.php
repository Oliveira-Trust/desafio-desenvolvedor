<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Compras
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <a href="{{ route('user-history.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Voltar
                </a>
            </div>

            <div class="mt-7 bg-white p-6">
                <form method="POST" action="{{ route('exchange.store') }}" class="w-full">
                    @csrf

                    <div class="grid gap-4 grid-cols-2">
                        <div>
                            <x-label for="origin_currency" :value="'Moeda de origem'" />
                            <x-select id="origin_currency" class="block mt-1 w-full" type="text" name="origin_currency" :options="[config('currency.origin') => config('currency.origin') ]" :disabled="true" />
                            <p class="text-red-500 text-xs italic">Por padrão utilizamos a moeda {{ config('currency.origin') }}.</p>
                        </div>

                        <div>
                            <x-label for="value" :value="'Valor para conversão'" />
                            <x-input id="value" class="block mt-1 w-full" type="number" name="value" step=".01" :value="old('value')" min="0" required autofocus />
                            @error('value')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4 grid gap-4 grid-cols-2">
                        <div>
                            <x-label for="destination_currency" :value="'Moeda de destino'" />
                            <x-select id="destination_currency" class="block mt-1 w-full" type="text" name="destination_currency" :options="$currencies" />
                            @error('destination_currency')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <x-label for="payment_method" :value="'Método de pagamento'" />
                            <x-select id="payment_method" class="block mt-1 w-full" type="text" name="payment_method" :options="['billet' => 'Boleto', 'credit_card' => 'Cartão de crédito']" />
                            @error('payment_method')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8">
                        <x-button>
                            Enviar
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
