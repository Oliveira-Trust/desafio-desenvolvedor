<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Métodos de Pagamentos') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Atualização das Taxas insidentes sobre os métodos de pagamentos') }}
        </p>
        <p class="mt-1 text-sm text-red-600">
            {{ __('* Os valores devem ser expressados em "forma decimal". Exemplo: 1% = 0.01') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="#">
        @csrf
    </form>

    <form method="post" action="{{ route('paymentMethods.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        @foreach ($paymentMethods as $paymentMethod)
            <div>
                <x-input-label for="{{ $paymentMethod->type }}" :value="$paymentMethod->label" />
                <x-text-input id="{{ $paymentMethod->type }}" name="{{ $paymentMethod->type }}" type="text"
                    class="mt-1 block w-full" :value="old($paymentMethod->type, $paymentMethod->value)" required autofocus
                    autocomplete="{{ $paymentMethod->type }}" step="0.00000001" />
                <x-input-error class="mt-2" :messages="$errors->get($paymentMethod->type)" />
            </div>
        @endforeach


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'payment-method-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
