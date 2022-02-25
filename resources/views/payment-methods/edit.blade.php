<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Taxas de pagamento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('payment-methods-update', $payment_method->id) }}" class=" mb-4">
                        @method('PUT')

                        @csrf                        
                        <x-label value="Taxa: {{ $payment_method->method_name }}" class="mb-2" />
                        <x-input class="block" type="number" name="fee" value="{{ $payment_method->fee }}" step="any" min="0" class="mb-3" required autofocus />
                        <div>
                            <a href="{{ url("/payment-methods") }}" class="text-sm text-gray-700 dark:text-gray-500 underline mr-4">{{ __('Voltar') }}</a>
                            
                            <x-button>
                                {{ __('Salvar') }}
                            </x-button>
                        </div>      
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
