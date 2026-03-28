@extends('layouts.app')
@section('title', 'Instrumentos')

@section('content')

    <div class="space-y-8">

        {{-- Header --}}
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Buscar Instrumentos</h1>
            <p class="text-sm text-gray-500 mt-1">Pesquise por ticker e/ou data de referência.</p>
        </div>

        {{-- Search Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form method="GET" action="{{ route('instruments.index') }}"
                  class="flex flex-wrap gap-4 items-end">

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Ticker (TckrSymb)</label>
                    <input type="text" name="TckrSymb" value="{{ $ticker }}"
                           placeholder="Ex: AMZO34"
                           class="border border-gray-300 rounded-lg px-3 py-2 text-sm w-40 uppercase
                              focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Data (RptDt)</label>
                    <input type="date" name="RptDt" value="{{ $date }}"
                           class="border border-gray-300 rounded-lg px-3 py-2 text-sm
                              focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <button type="submit"
                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Buscar
                </button>

                @if($ticker || $date)
                    <a href="{{ route('instruments.index') }}"
                       class="text-sm text-gray-500 hover:text-gray-700 py-2">
                        Limpar
                    </a>
                @endif

            </form>

            @error('TckrSymb') <p class="text-red-600 text-xs mt-2">{{ $message }}</p> @enderror
            @error('RptDt')    <p class="text-red-600 text-xs mt-2">{{ $message }}</p> @enderror
        </div>

        {{-- Results --}}
        @if($instruments !== null)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">

                {{-- Result count --}}
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <p class="text-sm text-gray-600">
                        <span class="font-semibold text-gray-900">{{ number_format($instruments->total()) }}</span>
                        resultado(s) encontrado(s)
                    </p>
                    @if($instruments->total() > 0)
                        <p class="text-xs text-gray-400">
                            Página {{ $instruments->currentPage() }} de {{ $instruments->lastPage() }}
                        </p>
                    @endif
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                        <tr class="bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            <th class="px-6 py-3">Ticker</th>
                            <th class="px-6 py-3">Data</th>
                            <th class="px-6 py-3">Mercado</th>
                            <th class="px-6 py-3">Categoria</th>
                            <th class="px-6 py-3">ISIN</th>
                            <th class="px-6 py-3">Empresa</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                        @forelse($instruments as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-mono font-semibold text-blue-700">
                                    {{ $item->TckrSymb }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $item->RptDt }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $item->MktNm ?? '—' }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700">
                                        {{ $item->SctyCtgyNm ?? '—' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-mono text-xs text-gray-500">
                                    {{ $item->ISIN ?? '—' }}
                                </td>
                                <td class="px-6 py-4 text-gray-800 max-w-xs truncate">
                                    {{ $item->CrpnNm ?? '—' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-400 text-sm">
                                    Nenhum instrumento encontrado para os filtros informados.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($instruments->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $instruments->links() }}
                    </div>
                @endif

            </div>

        @else

            {{-- Empty state --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-16 text-center">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <p class="text-gray-500 text-sm">Informe ao menos um filtro para buscar instrumentos.</p>
            </div>

        @endif

    </div>

@endsection
