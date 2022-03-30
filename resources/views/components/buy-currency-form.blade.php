@props(['open' => 'openModal'])

<div x-show="{{ $open }}"
     class="fixed h-full top-0 w-full flex flex-col justify-center items-center z-50 overflow-auto"
     @closemodal="{{ $open }} = false"
>
    <div class="fixed h-full top-0 w-full bg-black opacity-20"></div>
    <form method="POST"
          x-show="{{ $open }}"
          x-transition
          class="flex flex-col w-3/6 bg-white z-50 p-4 rounded-md mt-3"
          x-data="buyCurrencyForm"
          @submit.prevent="submitData($dispatch)"
    >
        @csrf
        <div class="flex justify-between border-b mb-3 py-3">
            <h2 class="font-bold uppercase text-xl">Nova compra de moeda estrangeira</h2>
        </div>
        <div class="mb-3">
            <div class="flex flex-col items-center">
                <div class="flex items-center items-end p-2">
                    <div class="flex items-end p-2">
                        <div class="p-2">BRL - R$</div>
                        <div class="flex flex-col">
                            <label for="value" class="font-bold">Valor que você quer pagar:</label>
                            <input type="number" name="value" id="value" placeholder="" x-model="formData.origin_currency_value">
                        </div>
                    </div>
                    <div class="flex items-end p-2">
                        <div class="flex flex-col">
                            <label for="value" class="font-bold">Forma de pagamento:</label>
                            <select x-model="formData.payment_type_id">
                                <option value="">Selecione</option>
                                @foreach ($paymentTypes as $paymentType)
                                    <option value="{{ $paymentType->id }}">
                                        {{ $paymentType->name }} (taxa: {{ $paymentType->fee }}%)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="flex items-end p-2">
                    <button type="button"
                            class="flex flex-col items-center justify-center overflow-hidden p-4 rounded-lg border border-gray-200 hover:bg-gray-100"
                            @click="convertCurrency()"
                    >
                        <x-application-logo class="w-16"/>
                        <span class="font-bold">Converter para</span>
                    </button>
                </div>
                <div class="flex items-center items-end p-2">
                    <div class="flex flex-col px-2">
                        <label for="value" class="font-bold">Moeda que você quer comprar</label>
                        <select x-model="formData.destination_currency_id" >
                            <option value="">Selecione</option>
                            @foreach ($currencies as $currency)
                                <option value="{{ $currency->id }}">
                                    {{ $currency->symbol }} - {{ $currency->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col px-2">
                        <label for="total" class="font-bold">Total convertido</label>
                        <p class="text-3xl"><span x-text="formData.converted_currency_value"></span></p>
                    </div>
                </div>
                <template x-if="formData.destination_currency_price">
                    <p>1 <span x-text="formData.destination_currency.symbol"></span> = <span x-text="formData.destination_currency_price"></span> BRL</p>
                </template>

                <template x-if="formData.payment_fee">
                    <p class="text-sm">Taxa de R$ <span x-text="formData.payment_fee_value"></span> (<span x-text="formData.payment_type.fee"></span>%) para pagamento em <span x-text="formData.payment_type.name"></span>.</p>
                </template>
                <template x-if="formData.convertion_fee">
                    <p class="text-sm">Taxa de R$ <span x-text="formData.convertion_fee_value"></span> (<span x-text="formData.convertion_fee"></span>%) sobre a conversão.</p>
                </template>
            </div>
        </div>
        <div class="flex justify-end border-t py-2">
            <button type="button" @click="{{ $open }} = false" class="mr-2">Cancelar</button>
            <button class="bg-blue-500 text-white p-2 rounded-md" type="submit">Comprar</button>
        </div>
    </form>
</div>
