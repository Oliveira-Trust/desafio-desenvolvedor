<div class="w-full rounded-lg border border-gray-200 bg-white shadow dark:border-gray-700 dark:bg-gray-800">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
            <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Usuário
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Forma de Pagamento
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Moeda de Origem
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Valor para Conversão
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Moeda de Destino
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Valor Comprado
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($quotes as $quote)
                    <tr
                        class="border-b odd:bg-white even:bg-gray-50 dark:border-gray-700 odd:dark:bg-gray-900 even:dark:bg-gray-800">
                        <th scope="row"
                            class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $quote->user_name ?? 'Usuário não Logado' }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $quote->payment_method_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $quote->origin_currency }}
                        </td>
                        <td class="px-6 py-4">
                            R$ {{ number_format($quote->amount, 2, ',', '.') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $quote->destination_currency }}
                        </td>
                        <td class="px-6 py-4">
                            {{ number_format($quote->converted_value, 2, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th colspan="6" class="p-4 text-center font-semibold text-white">
                            Nenhum resultado encontrado
                        </th>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-4 py-2">
        {{ $quotes->links() }}
    </div>
</div>
