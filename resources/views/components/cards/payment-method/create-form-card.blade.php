<div
    class="w-full rounded-lg border border-gray-200 bg-white p-2 shadow dark:border-gray-700 dark:bg-gray-800 sm:p-4 md:p-6">
    <h5 class="text-xl font-medium text-gray-900 dark:text-white">Taxa de Pagamento</h5>
    <form class="space-y-6" action="{{ route('settings.createPaymentMethod') }}" method="POST">
        @method('POST')
        @csrf
        <div class="grid grid-cols-2 gap-6">
            <x-forms.input error-bag="paymentMethod" type="text" name="name" label="Metodo de pagamento" />
            <x-forms.input error-bag="paymentMethod" type="text" name="label" class="uppercase" label="Label" />
            <x-forms.input error-bag="paymentMethod" type="text" name="tax"
                label="Percentual da taxa do pagamento" />
            <x-forms.toggle error-bag="paymentMethod" name="active" />
        </div>
        <x-forms.textarea error-bag="paymentMethod" name="description" label="Descrição" />
        <button type="submit"
            class="mt-3 w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Salvar
        </button>
    </form>
</div>
