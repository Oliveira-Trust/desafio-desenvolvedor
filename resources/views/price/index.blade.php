<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Team') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-jet-form-section submit="">

                <x-slot name="title">
                    {{ __('Últimas cotações') }}
                </x-slot>

                <x-slot name="description">
                    <div id="myPrices"></div>
                </x-slot>

                <x-slot name="form">
                    <div class="col-span-6">
                        <x-jet-label value="{{ __('Team Owner') }}" />

                        <div class="flex items-center mt-2">
                            <div class="ml-4 leading-tight">
                                <div>TESTE</div>
                                <div class="text-gray-700 text-sm">TESTE</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <form id="myForm" name="myForm">

                            <x-jet-label for="currency_from" value="{{ __('Team currency_from') }}" />
                            <x-jet-input id="currency_from" type="text" class="mt-1 block w-full"
                                wire:model.defer="state.currency_from" autofocus value="BRL" />

                            <x-jet-label for="currency_to" value="{{ __('Team currency_to') }}" />
                            <x-jet-input id="currency_to" type="text" class="mt-1 block w-full"
                                wire:model.defer="state.currency_to" autofocus value="USD" />

                            <x-jet-label for="total" value="{{ __('Team total') }}" />
                            <x-jet-input id="total" type="text" class="mt-1 block w-full" wire:model.defer="state.total"
                                autofocus value="5000" />

                            <x-jet-label for="payment_method" value="{{ __('Team payment_method') }}" />
                            <x-jet-input id="payment_method" type="text" class="mt-1 block w-full"
                                wire:model.defer="state.payment_method" autofocus value="ticket" />


                            <x-jet-input-error for="name" class="mt-2" />
                    </div>
                </x-slot>

                <x-slot name="actions">
                    <x-jet-button type="button" id="btn-save">
                        {{ __('Salvar') }}
                    </x-jet-button>
                </x-slot>

            </x-jet-form-section>
        </div>
    </div>
</x-app-layout>
