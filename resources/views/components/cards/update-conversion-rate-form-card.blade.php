<div
    class="w-full rounded-lg border border-gray-200 bg-white p-2 shadow dark:border-gray-700 dark:bg-gray-800 sm:p-4 md:p-6">
    <h5 class="text-xl font-medium text-gray-900 dark:text-white">Taxa de Conversão</h5>
    <form class="space-y-6" action="{{ route('settings.updateConversionRate') }}" method="POST">
        @method('POST')
        @csrf
        <x-forms.money type="text" label="Valor base" name="value" :value="$conversionRate->value" />
        <x-forms.input type="text" name="down" label="Percentual da taxa para valores abaixo do valor base"
            helper-text="Casa decimal separada por ponto" :value="$conversionRate->down" />
        <x-forms.input type="text" name="up" label="Percentual da taxa para valores acima do valor base"
            helper-text="Casa decimal separada por ponto" :value="$conversionRate->up" />
        <button type="submit"
            class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Salvar
        </button>
    </form>
</div>
