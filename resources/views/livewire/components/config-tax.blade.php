<div class="w-full p-6 bg-white">
    <form wire:submit="save()" class="gap-x-2 grid grid-cols-2 gap-y-4">
        <div class="col-span-1">
            <label for="paymentMethodTax1" class="@error('paymentMethodTax1') text-red-400 @enderror">
                Taxa para boleto
            </label>
            <input
                placeholder="00.00"
                type="number"
                id="paymentMethodTax1"
                wire:model.blur="paymentMethodTax1"
                step="0.00001"
                min="0"
                class="@error('paymentMethodTax1') border-red-400 @enderror col-span-4 block w-full p-2.5 text-gray-900 border rounded-lg bg-gray-50 text-base focus:ring-base-red focus:border-base-red mt-2">
        </div>
        <div class="col-span-1">
            <label for="paymentMethodTax2" class="@error('paymentMethodTax2') text-red-400 @enderror">
                Taxa para cartão
            </label>
            <input
                placeholder="00.00"
                type="number"
                id="paymentMethodTax2"
                wire:model.blur="paymentMethodTax2"
                step="0.00001"
                min="0"
                class="@error('paymentMethodTax2') border-red-400 @enderror col-span-4 block w-full p-2.5 text-gray-900 border rounded-lg bg-gray-50 text-base focus:ring-base-red focus:border-base-red mt-2">
        </div>
        <div class="col-span-1">
            <label for="taxConversion1" class="@error('taxConversion1') text-red-400 @enderror">
                Abaixo de R$ 3.000,00
            </label>
            <input
                placeholder="00.00"
                type="number"
                id="taxConversion1"
                wire:model.blur="taxConversion1"
                step="0.00001"
                min="0"
                class="@error('taxConversion1') border-red-400 @enderror col-span-4 block w-full p-2.5 text-gray-900 border rounded-lg bg-gray-50 text-base focus:ring-base-red focus:border-base-red mt-2">
        </div>
        <div class="col-span-1">
            <label for="taxConversion2" class="@error('taxConversion2') text-red-400 @enderror">
                Acima de R$ 3.000,00
            </label>
            <input
                placeholder="00.00"
                type="number"
                id="taxConversion2"
                wire:model.blur="taxConversion2"
                step="0.00001"
                min="0"
                class="@error('taxConversion2') border-red-400 @enderror col-span-4 block w-full p-2.5 text-gray-900 border rounded-lg bg-gray-50 text-base focus:ring-base-red focus:border-base-red mt-2">
        </div>

        <button type="submit" class="base-button col-span-full">Salvar</button>
    </form>
</div>
