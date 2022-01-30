<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Configurações de taxas') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-jet-form-section submit="">

                <div class="col-span-6">

                    <x-slot name="title">
                        {{ __('Configurações') }}
                    </x-slot>
        
                    <x-slot name="description">
                        {{ __('Aqui você pode definir qual será a moeda de origem padrão e as taxas de conversão para pagamento no Boleto e Cartão de crédito.') }}
                    </x-slot>

                </div>

                <x-slot name="form">


                    <div class="col-span-6 sm:col-span-4">
                        <form id="myForm" name="myForm">

                            <x-jet-label for="currency_from" value="{{ __('Moeda de origem (Padrão)') }}" />
                            <select id="currency_from"  class="mt-1 block w-full" name="currency_from" wire:model.defer="state.currency_from" autofocus>
                                <option value="BRL" selected> BRL </option>
                            </select>

                            <x-jet-label for="ticket" value="{{ __('Taxa para Boleto (%)') }}" />
                            <x-jet-input id="ticket" type="number" step=".01" min="1000" max="100000" class="mt-1 block w-full" wire:model.defer="state.ticket"
                                autofocus />

                            <x-jet-label for="card" value="{{ __('Taxa para Cartão de crédito (%)') }}" />
                            <x-jet-input id="card" type="number" step=".01" min="1000" max="100000" class="mt-1 block w-full" wire:model.defer="state.card"
                                autofocus />

                            <x-jet-input-error for="name" class="mt-2" />
                    </div>
                </x-slot>

                <x-slot name="actions">
                    <x-jet-button type="button" id="btn-save-setting">
                        {{ __('Salvar') }}
                    </x-jet-button>
                </x-slot>

            </x-jet-form-section>
        </div>
    </div>

</x-app-layout>
