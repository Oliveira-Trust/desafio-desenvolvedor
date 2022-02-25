<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Taxas de conversão') }}
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

                    <form method="POST" action="{{ route('conversion-rates-update', $conversion_rate->id) }}" class=" mb-4">
                        @method('PUT')

                        @csrf
                        
                        <div class="mb-4">
                            <x-label value="Aplicar a taxa:" class="mb-2" />
                            <x-input class="block" type="number" name="rate" value="{{ $conversion_rate->rate }}" step="any" min="0" class="mb-3" required autofocus />
                        </div>

                        <div class="mb-4">
                            <x-label value="{{ $conversion_rate->conditional_name }}:" class="mb-2" />
                            <x-input class="block js-input-money" type="text" name="value" value="{{ $conversion_rate->value }}" required autofocus />
                        </div>
                        
                        <div>
                            <a href="{{ url("/conversion-rates") }}" class="text-sm text-gray-700 dark:text-gray-500 underline mr-4">{{ __('Voltar') }}</a>
                            
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

<script>
    new VMasker(document.querySelector(".js-input-money")).maskMoney({
        precision: 2,
        separator: ',',
        delimiter: '.',
        unit: 'R$',
        zeroCents: true
    });
</script>
