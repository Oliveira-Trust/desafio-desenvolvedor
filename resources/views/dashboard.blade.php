@extends('layouts.app')
@section('title', 'Uploads')

@section('content')

    <div class="space-y-8">

        {{-- Header --}}
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Gerenciar Arquivos</h1>
            <p class="text-sm text-gray-500 mt-1">Envie arquivos CSV ou XLSX da B3 para processamento.</p>
        </div>

        {{-- Alerts --}}
        @if(session('success'))
            <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Upload Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-base font-semibold text-gray-800 mb-4">Enviar novo arquivo</h2>

            <form action="{{ route('dashboard.upload') }}" method="POST" enctype="multipart/form-data"
                  x-data="{ fileName: '', dragging: false }"
                  @dragover.prevent="dragging = true"
                  @dragleave.prevent="dragging = false"
                  @drop.prevent="
                  dragging = false;
                  const f = $event.dataTransfer.files[0];
                  fileName = f ? f.name : '';
                  $refs.fileInput.files = $event.dataTransfer.files;
              ">
                @csrf

                <div :class="dragging ? 'border-blue-400 bg-blue-50' : 'border-gray-300 bg-gray-50 hover:bg-gray-100'"
                     class="border-2 border-dashed rounded-lg p-8 text-center transition-colors cursor-pointer"
                     @click="$refs.fileInput.click()">

                    <svg class="w-10 h-10 text-gray-400 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>

                    <p class="text-sm text-gray-600" x-text="fileName || 'Clique ou arraste um arquivo aqui'"></p>
                    <p class="text-xs text-gray-400 mt-1">CSV, XLSX, XLS — máx. 100MB</p>

                    <input type="file" name="file" x-ref="fileInput" class="hidden"
                           accept=".csv,.xlsx,.xls"
                           @change="fileName = $event.target.files[0]?.name ?? ''">
                </div>

                <div class="mt-4 flex justify-end">
                    <button type="submit"
                            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Enviar arquivo
                    </button>
                </div>
            </form>
        </div>

        {{-- History --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">

            {{-- Filters --}}
            <div class="p-6 border-b border-gray-100">
                <form method="GET" action="{{ route('dashboard') }}" class="flex flex-wrap gap-3 items-end">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Nome do arquivo</label>
                        <input type="text" name="name" value="{{ request('name') }}"
                               placeholder="Ex: InstrumentsFile"
                               class="border border-gray-300 rounded-lg px-3 py-2 text-sm w-52 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Data de referência</label>
                        <input type="date" name="reference_date" value="{{ request('reference_date') }}"
                               class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <button type="submit"
                            class="bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                        Filtrar
                    </button>
                    @if(request()->hasAny(['name', 'reference_date']))
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700 py-2">
                            Limpar filtros
                        </a>
                    @endif
                </form>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                    <tr class="bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-3">Arquivo</th>
                        <th class="px-6 py-3">Data referência</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Registros</th>
                        <th class="px-6 py-3">Enviado em</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    @forelse($uploads as $upload)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-800 max-w-xs truncate">
                                {{ $upload->original_name }}
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $upload->reference_date ?? '—' }}
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $badge = match($upload->status) {
                                        'completed'  => 'bg-green-100 text-green-700',
                                        'processing' => 'bg-yellow-100 text-yellow-700',
                                        'pending'    => 'bg-gray-100 text-gray-600',
                                        'failed'     => 'bg-red-100 text-red-700',
                                        default      => 'bg-gray-100 text-gray-600',
                                    };
                                    $label = match($upload->status) {
                                        'completed'  => 'Concluído',
                                        'processing' => 'Processando',
                                        'pending'    => 'Pendente',
                                        'failed'     => 'Falhou',
                                        default      => $upload->status,
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badge }}">
                                    {{ $label }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                @if($upload->total_records > 0)
                                    {{ number_format($upload->processed_records) }} / {{ number_format($upload->total_records) }}
                                @else
                                    —
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-xs">
                                {{ $upload->created_at?->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400 text-sm">
                                Nenhum arquivo enviado ainda.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($uploads->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $uploads->links() }}
                </div>
            @endif

        </div>

    </div>

@endsection
