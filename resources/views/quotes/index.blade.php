<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quotes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div x-data="{
                        tableItems: [{
                                name: 'Solo learn app',
                                date: 'Oct 9, 2023',
                                status: 'Active',
                                price: '$35.000',
                                plan: 'Monthly subscription'
                            },
                            {
                                name: 'Window wrapper',
                                date: 'Oct 12, 2023',
                                status: 'Active',
                                price: '$12.000',
                                plan: 'Monthly subscription'
                            },
                            {
                                name: 'Unity loroin',
                                date: 'Oct 22, 2023',
                                status: 'Archived',
                                price: '$20.000',
                                plan: 'Annually subscription'
                            },
                            {
                                name: 'Background remover',
                                date: 'Jan 5, 2023',
                                status: 'Active',
                                price: '$5.000',
                                plan: 'Monthly subscription'
                            },
                            {
                                name: 'Colon tiger',
                                date: 'Jan 6, 2023',
                                status: 'Active',
                                price: '$9.000',
                                plan: 'Annually subscription'
                            }
                        ]
                    }" class="max-w-screen-xl mx-auto px-4 md:px-8">

                        <div class="items-start justify-between md:flex">
                            <div class="max-w-lg">
                                <h3 class="text-gray-800 text-xl font-bold sm:text-2xl">All products</h3>
                                <p class="text-gray-600 mt-2">Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry.</p>
                            </div>
                            <div class="mt-3 md:mt-0">
                                <a href="{{ route('quotes.create') }}"
                                    class="inline-block px-4 py-2 text-white duration-150 font-medium bg-indigo-600 rounded-lg hover:bg-indigo-500 active:bg-indigo-700 md:text-sm">Add
                                    product</a>
                            </div>
                        </div>
                        <div class="mt-12 relative h-max overflow-auto">
                            <table class="w-full table-auto text-sm text-left">
                                <thead class="text-gray-600 font-medium border-b">
                                    <tr>
                                        <th class="py-3 pr-6">name</th>
                                        <th class="py-3 pr-6">date</th>
                                        <th class="py-3 pr-6">status</th>
                                        <th class="py-3 pr-6">Purchase</th>
                                        <th class="py-3 pr-6">price</th>
                                        <th class="py-3 pr-6"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 divide-y">
                                    <template x-for="(item, idx) in tableItems" :key="idx">
                                        <tr>
                                            <td class="pr-6 py-4 whitespace-nowrap" x-text="item.name"></td>
                                            <td class="pr-6 py-4 whitespace-nowrap" x-text="item.date"></td>
                                            <td class="pr-6 py-4 whitespace-nowrap">
                                                <span
                                                    :class="`px-3 py-2 rounded-full font-semibold text-xs ${item.status === 'Active' ? 'text-green-600 bg-green-50' : 'text-blue-600 bg-blue-50'}`"
                                                    x-text="item.status"></span>
                                            </td>
                                            <td class="pr-6 py-4 whitespace-nowrap" x-text="item.plan"></td>
                                            <td class="pr-6 py-4 whitespace-nowrap" x-text="item.price"></td>
                                            <td class="text-right whitespace-nowrap">
                                                <a href="javascript:void(0)"
                                                    class="py-1.5 px-3 text-gray-600 hover:text-gray-500 duration-150 hover:bg-gray-50 border rounded-lg">Manage</a>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
