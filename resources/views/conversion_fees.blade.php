<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Taxas de conversões') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="dataConversionFee" @searchconversionfees="searchConversionFee()">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-init="searchConversionFee()">
            <div class="grid grid-cols-3">
                <div class="p-2">
                    <button @click="openModal = true" class="flex flex-col justify-center items-center bg-white overflow-hidden shadow-sm sm:rounded-lg w-full h-full hover:bg-blue-500 hover:text-white text-blue-500 py-10">
                        <div class="text-3xl uppercase font-bold">
                            Nova taxa
                        </div>
                    </button>
                </div>
                <template x-for="(conversionFee, i) in conversionFees">

                    <div class="p-2" x-data="dataConversionFeeForm">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" x-data="{edit: false}"
                             @conversionfeesaved="$event.detail.id === conversionFees[i].id ? edit = false : ''; ">
                            <div class="flex flex-col p-6 bg-white border-b border-gray-200">
                                <div class="py-2">
                                    <h2 class="font-bold text-xl" x-text="conversionFees[i].name"></h2>
                                    <div
                                    >
                                        <template x-if="edit === false">
                                            <p>
                                                <span x-text="conversionFees[i].fee"></span> % para valores <span x-text="conversionFees[i].comparison_operator"></span> que <span x-text="conversionFees[i].comparator_value"></span>
                                                <button class="text-xs border border-blue-500 py-1 px-2 hover:bg-blue-500 hover:text-white" @click="edit = true">Editar</button>
                                            </p>
                                        </template>

                                        <div class="mb-2">
                                            <template x-if="edit === true">
                                                <div x-data="{formDataUpdate: {
                                                                    fee: conversionFees[i].fee,
                                                                    comparison_operator: conversionFees[i].comparison_operator,
                                                                    comparator_value: conversionFees[i].comparator_value
                                                                    }}">
                                                    <div class="flex" >
                                                        <div class="flex flex-col pr-2">
                                                            <label class="text-xs">Taxa (%)</label>
                                                            <div class="flex">
                                                                <input type="number" x-model="formDataUpdate.fee" class="w-20 h-8" min="0" max="100" step=".01">
                                                            </div>
                                                        </div>
                                                        <div class="flex flex-col px-2">
                                                            <label class="text-xs">Comparador</label>
                                                            <select x-model="formDataUpdate.comparison_operator" class="w-20 h-8 py-1">
                                                                <option value=">"> > (maior que)</option>
                                                                <option value="<"> < (menor que)</option>
                                                                <option value=">="> >= (maior ou igual a)</option>
                                                                <option value="<="> <= (menor ou igual a)</option>
                                                            </select>
                                                        </div>
                                                        <div class="flex flex-col px-2">
                                                            <label class="text-xs">Valor comparador (R$)</label>
                                                            <input type="number" x-model="formDataUpdate.comparator_value" class="w-24 h-8" min="0" max="10000000" step=".01">
                                                        </div>
                                                    </div>
                                                    <div class="py-2">
                                                        <button class="text-xs border border-blue-500 py-1 px-2 hover:bg-blue-500 hover:text-white"
                                                                @click="updateConversionFee(formDataUpdate, conversionFees[i].id)">Salvar</button>
                                                        <button class="text-xs border border-blue-500 py-1 px-2 hover:bg-blue-500 hover:text-white"
                                                                @click="formDataUpdate = {
                                                                        fee: conversionFees[i].fee,
                                                                        comparison_operator: conversionFees[i].comparison_operator,
                                                                        comparator_value: conversionFees[i].comparator_value
                                                                        }; edit=false">Cancelar</button>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>

                                        <div class="flex justify-end">
                                            <button class="text-xs border py-1 px-2 hover:bg-blue-500 hover:text-white"
                                                    :class="conversionFees[i].status ? 'bg-blue-500 text-white' : ''"
                                                    @click="updateConversionFee({status: true}, conversionFees[i].id)"
                                            >Ativo</button>
                                            <button class="text-xs border py-1 px-2 hover:bg-red-500 hover:text-white"
                                                    :class="!conversionFees[i].status ? 'bg-red-500 text-white' : ''"
                                                    @click="updateConversionFee({status: false}, conversionFees[i].id)"
                                            >Inativo</button>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <x-conversion-fee-form open="openModal"/>

    </div>

</x-app-layout>

