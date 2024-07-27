<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Moeda
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Compra
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Venda
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Data/hora
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    Moeda
                                </th>
                                <td class="px-6 py-4">
                                    Compra
                                </td>
                                <td class="px-6 py-4">
                                    Venda
                                </td>
                                <td class="px-6 py-4">
                                    Data/hora
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="relative overflow-x-auto mt-3">
                        <div class="mt-3 bg-gray-600 py-1 px-1 text-gray-100 sm:rounded">Faça sua cotação</div>
                        <form method="post" action="#">
                            @csrf
                            <div>
                                <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Small input</label>
                                <input type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
