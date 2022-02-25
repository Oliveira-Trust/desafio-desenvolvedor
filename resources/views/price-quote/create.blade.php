<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cotação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="text-red-600 mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('price-quote') }}">
                        @csrf

                        <div class="mb-4">
                            <x-label :value="__('Moeda de origem')" />
                            <x-input class="block mt-1 w-full " type="text" value="BRL" required autofocus disabled readonly />
                        </div>

                        <div class="mb-4">
                            <x-label for="value" :value="__('Valor de compra')" />
                            <x-input id="value" class="block mt-1 w-full js-input-money" type="text" name="value" required autofocus />
                        </div>
                        
                        <div class="mb-4">
                            <x-label for="currency" :value="__('Moeda de destino')" />
                            <x-select id="currency" class="block mt-1 w-full" name="currency" :options="$currencies" required />
                        </div>

                        <div class="mb-4">
                            <x-label for="currency" :value="__('Forma de pagamento')" />
                            <x-select-payment-method id="currency" class="block mt-1 w-full" name="payment_method_id" :options="$payment_methods" required />
                        </div>

                        <x-button>
                            {{ __('Converter') }}
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    VMasker(document.querySelector(".js-input-money")).maskMoney({
        precision: 2,
        separator: ',',
        delimiter: '.',
        unit: 'R$',
        zeroCents: true
    });
</script>
