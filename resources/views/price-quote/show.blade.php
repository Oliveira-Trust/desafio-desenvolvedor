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
                    <div class="mb-4">
                        <p class="block font-medium text-sm text-gray-700">Moeda de origem: <b>{{ $price_quote->from_currency }}</b></p>
                        <p class="block font-medium text-sm text-gray-700">Moeda de destino: <b>{{ $price_quote->to_currency }}</b></p>
                        <p class="block font-medium text-sm text-gray-700">Valor para conversão: <b>R$ @convert($price_quote->value)</b></p>
                        <p class="block font-medium text-sm text-gray-700">Forma de pagamento: <b>{{ $price_quote->paymentMethod->method_name }}</b></p>
                        <p class="block font-medium text-sm text-gray-700">Valor de "{{ $price_quote->to_currency }}" usado para conversão: <b>{{ $price_quote->currency_symbol }} @convert($price_quote->currency_value)</b></p>
                        <p class="block font-medium text-sm text-gray-700">Valor comprado em "{{ $price_quote->to_currency }}": <b>{{ $price_quote->currency_symbol }} @convert($price_quote->purchase_price)</b></p>
                        <p class="block font-medium text-sm text-gray-700">Taxa de pagamento: <b>R$ @convert($price_quote->payment_rate)</b></p>
                        <p class="block font-medium text-sm text-gray-700">Taxa de conversão: <b>R$ @convert($price_quote->conversion_rate)</b></p>
                        <p class="block font-medium text-sm text-gray-700">Valor utilizado para conversão descontando as taxas: <b>R$ @convert($price_quote->discounted_value)</b></p>
                    </div>

                    <div class="flex items-center">
                        <a href="{{ url("/history") }}" class="text-sm text-gray-700 dark:text-gray-500 underline mr-4">{{ __('Acessar histórico') }}</a>
                        <form method="POST" action="{{ route('send-email', ['price_quote' => $price_quote]) }}">
                            @csrf
    
                            <x-button>
                                {{ __('Enviar por e-mail') }}
                            </x-button>
                        </form> 
                    </div>               
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
