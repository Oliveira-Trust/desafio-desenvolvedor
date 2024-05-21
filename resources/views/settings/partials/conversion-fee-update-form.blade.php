<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Taxas de conversões') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Atualização das Taxas insidentes sobre a conversão de moedas') }}
        </p>
        <p class="mt-1 text-sm text-red-600">
            {{ __('* Os valores devem ser expressados em "forma decimal". Exemplo: 1% = 0.01') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="#">
        @csrf
    </form>

    <form method="post" action="{{ route('feeRules.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        <div>
            <x-input-label for="base-value" :value="__('Valor Base')" />
            <x-text-input id="base-value" name="base_value" type="number" class="mt-1 block w-full" :value="old('base_value', $feeRules->first()->value)"
                required autofocus autocomplete="base_value" step="0.01" />
            <x-input-error class="mt-2" :messages="$errors->get('base_value')" />

        </div>
        @foreach ($feeRules as $index => $feeRule)
            <div>
                <x-input-label for="rule-{{ $index }}-fee" :value="$feeRule->label" />
                <input type="hidden" name="rules[{{ $index }}][id]" value="{{ $feeRule->id }}">
                <x-text-input id="rule-{{ $index }}-fee" name="rules[{{ $index }}][fee]" type="number"
                    class="mt-1 block w-full" :value="old('rules[{{ $index }}][fee]', $feeRule->fee)" required autofocus
                    autocomplete="rules[{{ $index }}][fee]" step="0.00000001" />
                <x-input-error class="mt-2" :messages="$errors->get('rules[{{ $index }}][fee]')" />

            </div>
        @endforeach


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'fee-rules-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
