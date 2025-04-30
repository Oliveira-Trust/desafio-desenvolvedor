@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Detalhes do Upload</h1>
    <a href="{{ route('uploads.index') }}" class="text-blue-600 hover:text-blue-800">
        ← Voltar para a lista
    </a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
    <div class="border-b border-gray-200 px-6 py-4">
        <h2 class="text-lg font-medium text-gray-800">Informações Gerais</h2>
    </div>
    <div class="p-6">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
            <div>
                <dt class="text-sm font-medium text-gray-500">ID</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $upload->id }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Nome Original</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $upload->original_name }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Nome do Arquivo</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $upload->file_name }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Data de Referência</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $upload->reference_date ? $upload->reference_date->format('d/m/Y') : 'N/A' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Status</dt>
                <dd class="mt-1 text-sm">
                    @if($upload->status == 'completed')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Concluído
                    </span>
                    @elseif($upload->status == 'processing')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                        Processando
                    </span>
                    @elseif($upload->status == 'failed')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                        Falha
                    </span>
                    @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                        Pendente
                    </span>
                    @endif
                </dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Total de Registros</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $upload->total_records ?? 'N/A' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Hash do Arquivo</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $upload->file_hash }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Criado em</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $upload->created_at->format('d/m/Y H:i:s') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Processado em</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $upload->processed_at ? $upload->processed_at->format('d/m/Y H:i:s') : 'N/A' }}</dd>
            </div>
        </dl>
    </div>
</div>

@if($upload->status == 'failed' && $upload->error_message)
<div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
    <div class="border-b border-gray-200 px-6 py-4 bg-red-50">
        <h2 class="text-lg font-medium text-red-800">Erro ao Processar</h2>
    </div>
    <div class="p-6 bg-red-50">
        <div class="text-sm text-red-700">
            {{ $upload->error_message }}
        </div>
    </div>
</div>
@endif

@if($upload->status == 'completed' && isset($previewData) && count($previewData) > 0)
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="border-b border-gray-200 px-6 py-4">
        <h2 class="text-lg font-medium text-gray-800">Prévia dos Dados (primeiros 10 registros)</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    @foreach(array_keys($previewData[0]) as $column)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ $column }}
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($previewData as $row)
                <tr>
                    @foreach($row as $value)
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $value }}
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-200">
        <p class="text-sm text-gray-600">
            Mostrando {{ count($previewData) }} de {{ $upload->total_records }} registros.
            <a href="{{ route('data.search', ['upload_id' => $upload->id]) }}" class="text-blue-600 hover:text-blue-800">
                Ver todos os dados →
            </a>
        </p>
    </div>
</div>
@endif
@endsection 