<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Painel de cotações') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-jet-form-section submit="">

                <x-slot name="title" class='text-center'>
                    {{ __('Histórico de cotações') }}
                </x-slot>

                <x-slot name="description">
                    <div id="myPrices" class="col-span-6"></div>
                    
                    <div id="legend" class="col-span-6 sm:col-span-4 text-sm" style='display:none'>
                         
                        <b>TP</b>: Taxa de pagamento <br />
                        <b>TC</b>: Taxa de conversão <br />
                        <b>VC</b>: Valor comprado em "Moeda de destino"
                    
                    </div>

                </x-slot>

                <x-slot name="form">
                    <div class="col-span-6">
                 

                        <div class="flex items-center mt-2">
                            <div class="ml-4 leading-tight">
                                <div>Solicitar cotação</div>
      
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <form id="myForm" name="myForm">

                            <x-jet-label for="currency_from" value="{{ __('Moeda de origem') }}" />
                            <select id="currency_from"  class="mt-1 block w-full" name="currency_from" wire:model.defer="state.currency_from" autofocus>
                                <option value="BRL" selected> BRL </option>
                            </select>

                            <x-jet-label for="currency_to" value="{{ __('Moeda de origem') }}" />
                            <select id="currency_to"  class="mt-1 block w-full" name="currency_to" wire:model.defer="state.currency_to" autofocus multiple>
                                <option value="USD" selected> USD </option>
                                <option value="EUR"> EUR </option>
                            </select>

                            <x-jet-label for="total" value="{{ __('Total') }}" />
                            <x-jet-input id="total" type="number" step=".01" min="1000" max="100000" class="mt-1 block w-full" wire:model.defer="state.total"
                                autofocus value="1000" />

                            <x-jet-label for="payment_method" value="{{ __('Forma de pagamento') }}" />
                            <select id="payment_method"  class="mt-1 block w-full" name="payment_method" wire:model.defer="state.payment_method" autofocus>
                                <option value="ticket" > Boleto </option>
                                <option value="card" > Cartão </option>
                            </select>

                            <x-jet-input-error for="name" class="mt-2"/>

                            <div id="feedback"></div>
                    </div>
                </x-slot>

                <x-slot name="actions">
                    <x-jet-button type="button" id="btn-save">
                        {{ __('Solicitar') }}
                    </x-jet-button>
                </x-slot>

            </x-jet-form-section>
        </div>
    </div>

    <div class="modal fade" id="formModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="formModalLabel">Cotações</h4>
                </div>
                <div class="modal-body" id=todo-list>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-close"> Fechar
                    </button>
    
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
