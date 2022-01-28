<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <x-jet-form-section submit="createTeam">
            
            <x-slot name="form">
                <div class="col-span-6">

                    <x-slot name="title">
                        {{ __('Team Details') }}
                    </x-slot>
        
                    <x-slot name="description">
                        {{ __('Create a new team to collaborate with others on projects.') }}
                    </x-slot>

                </div>

                <!--form para cotação-->
                <div class="col-span-6 sm:col-span-4">
                    <form id="myForm" name="myForm">
                        @csrf

                        <div>
                            <x-jet-label for="currency_from" value="{{ __('Moeda de origem') }}" />
                            <x-jet-input id="currency_from" class="block mt-1 w-full" type="text" name="currency_from"
                                :value="old('currency_from')" value="BRL" required />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="currency_to" value="{{ __('Moeda de destino') }}" />
                            <x-jet-input id="currency_to" class="block mt-1 w-full" type="text" name="currency_to"
                                :value="old('currency_to')" value="USD" required />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="total" value="{{ __('Valor para conversão') }}" />
                            <x-jet-input id="total" class="block mt-1 w-full" type="number" name="total"
                                :value="old('total')" value="5000" required />
                        </div>


                        <div class="mt-4">
                            <x-jet-label for="payment_method" value="{{ __('Forma de pagamento') }}" />
                            <x-jet-input id="payment_method" class="block mt-1 w-full" type="text" name="payment_method"
                                :value="old('payment_method')" value="ticket" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <x-jet-button class="ml-4" id="btn-save">
                                {{ __('Solicitar cotação') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>

            </x-slot>

        </x-jet-form-section>

    </div>

</x-app-layout>
