<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Taxas de conversão') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="relative rounded-xl overflow-auto">
                        <div class="shadow-sm overflow-hidden my-8">
                            <table class="border-collapse table-auto w-full text-sm">
                                <thead>
                                  <tr>
                                    <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Taxa</th>
                                    <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Condição</th>
                                    <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Valor</th>
                                    @can('admin')
                                        <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Ações</th>
                                    @endcan
                                  </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-slate-800">
                                    @foreach ($conversion_rates as $conversion_rate)
                                        <tr>
                                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $conversion_rate->rate }}%</td>
                                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $conversion_rate->conditional_name }}</td>
                                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">R$ @convert($conversion_rate->value)</td>
                                            @can('admin')
                                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                                    <a href="{{ url("/conversion-rates/{$conversion_rate->id}/edit") }}" class="text-sm text-gray-700 dark:text-gray-500 underline">{{ __('Editar') }}</a>
                                                </td>
                                            @endcan
                                        </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
