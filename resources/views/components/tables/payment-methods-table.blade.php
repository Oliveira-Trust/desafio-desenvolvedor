<div class="mt-6 block max-h-96 overflow-auto shadow-md sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:bg-gray-800 dark:text-gray-400">
        <thead class="sticky top-0 text-xs uppercase text-gray-700 dark:bg-gray-800 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nome
                </th>
                <th scope="col" class="px-6 py-3">
                    Descrição
                </th>
                <th scope="col" class="px-6 py-3">
                    Porcentagem
                </th>
                <th scope="col" class="px-6 py-3">
                    Ativo
                </th>
            </tr>
        </thead>
        <tbody class="mt-5 max-h-80 overflow-y-auto">
            @forelse ($paymentMethods as $paymentMethod)
                <tr class="cursor-pointer border-b border-gray-200 dark:border-gray-700"
                    title="Editar forma de pagamento: {{ $paymentMethod->name }}" x-data
                    x-on:click.prevent="$dispatch('open-modal', 'update-{{ $paymentMethod->id }}')">
                    <th scope="row"
                        class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:bg-gray-800 dark:text-white">
                        {{ $paymentMethod->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $paymentMethod->description }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $paymentMethod->tax }}
                    </td>
                    <td class="flex h-full items-center justify-center px-6 py-4">
                        @if ($paymentMethod->active)
                            <svg class="h-3 w-3 text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                            </svg>
                        @else
                            <svg class="h-3 w-3 text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        @endif
                    </td>
                    <x-modal name="update-{{ $paymentMethod->id }}" :show="$errors->{'paymentMethod' . $paymentMethod->id}->isNotEmpty()" focusable>
                        <x-cards.payment-method.update-form-card :id="$paymentMethod->id" />
                    </x-modal>
                </tr>
            @empty
                <tr>
                    <th colspan="4" class="p-4 text-center font-semibold text-white">
                        Nenhum resultado encontrado
                    </th>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
