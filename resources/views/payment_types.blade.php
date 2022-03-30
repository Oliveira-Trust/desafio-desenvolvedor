<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Formas de pagamento') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="dataPaymentTypes" @searchpaymenttypes="searchPaymentTypes()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-init="searchPaymentTypes()">
            <div class="grid grid-cols-3">
                <template x-for="paymentType in paymentTypes">
                    <div class="p-2">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="flex flex-col p-6 bg-white border-b border-gray-200">
                                <div class="py-2">
                                    <h2 class="font-bold text-xl" x-text="paymentType.name"></h2>
                                    <div x-data="{edit: false}" @paymenttypesaved="$event.detail.id === paymentType.id ? edit = false : ''">
                                        <template x-if="edit === false">
                                            <p>
                                                <span x-text="paymentType.fee"></span> %
                                                <button class="text-xs border border-blue-500 py-1 px-2 hover:bg-blue-500 hover:text-white" @click="edit = true">Editar</button>
                                            </p>
                                        </template>
                                        <template x-if="edit === true" >
                                            <p x-data="{formData: {fee: paymentType.fee}}">
                                                <input type="number" x-model="formData.fee" class="w-24" min="0" max="100" step=".01"> %
                                                <button class="text-xs border border-blue-500 py-1 px-2 hover:bg-blue-500 hover:text-white" @click="savePaymentType(formData, paymentType.id)">Salvar</button>
                                                <button class="text-xs border border-blue-500 py-1 px-2 hover:bg-blue-500 hover:text-white" @click="formData = {fee: paymentType.fee}; edit=false">Cancelar</button>
                                            </p>
                                        </template>
                                    </div>
                                </div>
                                <div class="flex justify-end">
                                    <button class="text-xs border py-1 px-2 hover:bg-blue-500 hover:text-white"
                                            :class="paymentType.status ? 'bg-blue-500 text-white' : ''"
                                            @click="savePaymentType({status: true}, paymentType.id)"
                                    >Ativo</button>
                                    <button class="text-xs border py-1 px-2 hover:bg-red-500 hover:text-white"
                                            :class="!paymentType.status ? 'bg-red-500 text-white' : ''"
                                            @click="savePaymentType({status: false}, paymentType.id)"
                                    >Inativo</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

</x-app-layout>

