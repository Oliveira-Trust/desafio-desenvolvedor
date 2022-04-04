@props(['open' => 'openModal'])

<div x-show="{{ $open }}"
     class="fixed h-full top-0 w-full flex flex-col justify-center items-center z-50 overflow-auto"
     @closemodal="{{ $open }} = false"
>
    <div class="fixed h-full top-0 w-full bg-black opacity-20"></div>
    <form method="POST"
          x-show="{{ $open }}"
          x-transition
          class="flex flex-col w-5/6 md:w-2/6 lg:w-2/6 bg-white z-50 p-4 rounded-md mt-3"
          @submit.prevent="createConversionFee($dispatch)"
    >
        @csrf
        <div class="flex justify-between border-b mb-3 py-3">
            <h2 class="font-bold uppercase text-xl">Nova taxa de conversão</h2>
        </div>
        <div class="mb-3">
            <div class="flex flex-col">
                <div >
                    <div>
                        <div class="flex flex-col mb-2">
                            <label class="font-bold">Taxa (%)</label>
                            <div class="flex">
                                <input type="number" x-model="formData.fee" class="w-full"  min="0" max="100" step=".01">
                            </div>
                        </div>
                        <div class="flex flex-col mb-2">
                            <label class="font-bold">Comparador</label>
                            <select x-model="formData.comparison_operator" class="w-full">
                                <option value="">Selecione</option>
                                <option value=">"> > (maior que)</option>
                                <option value="<"> < (menor que)</option>
                                <option value=">="> >= (maior ou igual a)</option>
                                <option value="<="> <= (menor ou igual a)</option>
                            </select>
                        </div>
                        <div class="flex flex-col mb-2">
                            <label class="font-bold">Valor comparador (R$)</label>
                            <input type="number" x-model="formData.comparator_value" min="0" max="10000000" step=".01" class="w-full">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end border-t py-2">
            <button type="button" @click="{{ $open }} = false" class="mr-2">Cancelar</button>
            <button class="bg-blue-500 text-white p-2 rounded-md" type="submit">Salvar</button>
        </div>
    </form>
</div>
