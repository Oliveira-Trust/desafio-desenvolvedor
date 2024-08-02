<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Configuração') }}
        </h2>
    </x-slot>

    <div class="mx-auto grid max-w-7xl grid-cols-2 gap-6 py-12 sm:px-6 lg:px-8">
        <x-cards.update-conversion-rate-form-card />
        <x-cards.payment-method.payment-methods-card />
    </div>
</x-app-layout>
