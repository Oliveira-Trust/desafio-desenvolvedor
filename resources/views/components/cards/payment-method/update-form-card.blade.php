<div
    class="w-full rounded-lg border border-gray-200 bg-white p-2 shadow dark:border-gray-700 dark:bg-gray-800 sm:p-4 md:p-6">
    <h5 class="mb-5 text-xl font-medium text-gray-900 dark:text-white">Taxa de Pagamento</h5>
    <form class="space-y-6" action="{{ route('settings.updatePaymentMethod') }}" method="POST">
        @method('POST')
        @csrf
        <div class="grid grid-cols-2 gap-6">
            <input type="hidden" name="id" value="{{ $paymentMethod->id }}" />
            <x-forms.input :error-bag="'paymentMethod' . $paymentMethod->id" type="text" name="name" label="Metodo de pagamento"
                value="{{ $paymentMethod->name }}" />
            <x-forms.input :error-bag="'paymentMethod' . $paymentMethod->id" type="text" name="label" class="uppercase" label="Label"
                value="{{ $paymentMethod->label }}" />
            <x-forms.input :error-bag="'paymentMethod' . $paymentMethod->id" type="text" name="tax" label="Percentual da taxa do pagamento"
                value="{{ $paymentMethod->tax }}" />
            <x-forms.toggle :error-bag="'paymentMethod' . $paymentMethod->id" name="active" :checked="$paymentMethod->active" />
        </div>
        <div class="mt-6">
            <x-forms.textarea :error-bag="'paymentMethod' . $paymentMethod->id" name="description" label="Descrição" :value="$paymentMethod->description" />
        </div>
        <button type="submit"
            class="mt-3 w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Salvar
        </button>
    </form>
</div>
