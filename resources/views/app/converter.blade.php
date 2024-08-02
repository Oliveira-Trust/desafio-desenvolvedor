<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Conversor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-cards.conversion-form-card :action="route('app.converter')" />

            @isset($data)
                <div class="my-6">
                    <x-cards.converted-card :data="$data" />
                </div>
            @endisset
        </div>
    </div>
</x-app-layout>
