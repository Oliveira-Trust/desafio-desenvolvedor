@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Consulta de Dados Financeiros</h1>
    <p class="text-sm text-gray-600 mt-1">Busque dados financeiros processados a partir dos arquivos enviados.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <!-- Filtros de Pesquisa -->
    <div class="md:col-span-1">
        <div class="bg-white shadow-md rounded-lg overflow-hidden sticky top-4">
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="text-lg font-medium text-gray-800">Filtros</h2>
            </div>
            <div class="p-6">
                <form id="search-form" action="{{ route('data.search') }}" method="GET">
                    <!-- Data de Início -->
                    <div class="mb-4">
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">
                            Data de Início
                        </label>
                        <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" 
                               class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>
                    
                    <!-- Data de Fim -->
                    <div class="mb-4">
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">
                            Data de Fim
                        </label>
                        <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" 
                               class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>
                    
                    <!-- Ticker Symbol -->
                    <div class="mb-4">
                        <label for="symbol" class="block text-sm font-medium text-gray-700 mb-1">
                            Símbolo (Ticker)
                        </label>
                        <input type="text" id="symbol" name="symbol" value="{{ request('symbol') }}" placeholder="Ex: AAPL, MSFT" 
                               class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>
                    
                    <!-- Mercado -->
                    <div class="mb-4">
                        <label for="market" class="block text-sm font-medium text-gray-700 mb-1">
                            Mercado
                        </label>
                        <input type="text" id="market" name="market" value="{{ request('market') }}" placeholder="Ex: NASDAQ, NYSE" 
                               class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>
                    
                    <!-- Categoria -->
                    <div class="mb-4">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">
                            Categoria
                        </label>
                        <input type="text" id="category" name="category" value="{{ request('category') }}" placeholder="Ex: Equity, Bond" 
                               class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>
                    
                    <!-- ISIN -->
                    <div class="mb-4">
                        <label for="isin" class="block text-sm font-medium text-gray-700 mb-1">
                            ISIN
                        </label>
                        <input type="text" id="isin" name="isin" value="{{ request('isin') }}" placeholder="Ex: US0378331005" 
                               class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>
                    
                    <!-- Nome da Empresa -->
                    <div class="mb-4">
                        <label for="company" class="block text-sm font-medium text-gray-700 mb-1">
                            Nome da Empresa
                        </label>
                        <input type="text" id="company" name="company" value="{{ request('company') }}" placeholder="Ex: Apple Inc." 
                               class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>
                    
                    <!-- Upload ID -->
                    <div class="mb-6">
                        <label for="upload_id" class="block text-sm font-medium text-gray-700 mb-1">
                            ID do Upload
                        </label>
                        <input type="text" id="upload_id" name="upload_id" value="{{ request('upload_id') }}" placeholder="Ex: 123" 
                               class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                            Buscar
                        </button>
                    </div>
                    
                    @if(request()->anyFilled(['start_date', 'end_date', 'symbol', 'market', 'category', 'isin', 'company', 'upload_id']))
                    <div class="mt-4">
                        <a href="{{ route('data.search') }}" class="text-sm text-blue-600 hover:text-blue-800">
                            Limpar Filtros
                        </a>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
    
    <!-- Resultados da Pesquisa -->
    <div class="md:col-span-3">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-800">Resultados da Pesquisa</h2>
                
                @if(isset($total))
                <div class="text-sm text-gray-500">
                    {{ $total }} resultados encontrados
                </div>
                @endif
            </div>
            
            @if(isset($results) && count($results) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Data
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Símbolo
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Mercado
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Categoria
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ISIN
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Empresa
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($results as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ isset($item['RptDt']) ? \Carbon\Carbon::parse($item['RptDt'])->format('d/m/Y') : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $item['TckrSymb'] ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item['MktNm'] ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item['SctyCtgyNm'] ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item['ISIN'] ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item['CrpnNm'] ?? 'N/A' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if(method_exists($results, 'links'))
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $results->appends(request()->all())->links() }}
            </div>
            @endif
            
            @elseif(request()->anyFilled(['start_date', 'end_date', 'symbol', 'market', 'category', 'isin', 'company', 'upload_id']))
            <div class="p-6 text-center">
                <p class="text-gray-500">Nenhum resultado encontrado para os filtros aplicados.</p>
            </div>
            @else
            <div class="p-6 text-center">
                <p class="text-gray-500">Use os filtros para buscar dados financeiros.</p>
            </div>
            @endif
        </div>
        
        @if(isset($results) && count($results) > 0)
        <div class="mt-6 flex justify-end">
            <a href="{{ route('data.export', request()->all()) }}" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Exportar para Excel
            </a>
        </div>
        @endif
    </div>
</div>
@endsection 