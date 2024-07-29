<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            
            @if (isset($error))
                <div class="bg-red-500 text-white p-4 rounded mt-6">
                    {{ $error }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-700 mb-4">{{ __('Cotação de Moedas') }}</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 tracking-wider">Moeda</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 tracking-wider">Código</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 tracking-wider">Cotação em Real/BRL</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 tracking-wider">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($exchangeDetails))
                                    @foreach ($exchangeDetails as $exchangeDetail)
                                        <tr>
                                            <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5 text-gray-800">{{ $exchangeDetail['coinInName'] ?? null }}</td>
                                            <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5 text-gray-800">{{ $exchangeDetail['codeIn'] ?? null }}</td>
                                            <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5 text-gray-800">{{ $exchangeDetail['bid'] ?? null }}</td>
                                            <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5 text-gray-800">
                                                <a
                                                href="{{ route('exchange', ['transaction' => $exchangeDetail['transaction']]) }}"
                                                class="inline-block px-6 py-2.5 border rounded-md border-primary text-primary hover:bg-primary hover:text-white font-medium">
                                                Comprar
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5 text-gray-800">Não foi possivel listar moedas</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
