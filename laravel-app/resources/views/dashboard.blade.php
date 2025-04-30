@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Card de Estatísticas de Uploads -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-blue-600 text-white px-4 py-2">
            <h3 class="text-lg font-semibold">Uploads</h3>
        </div>
        <div class="p-4">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <p class="text-xl font-bold">{{ $uploadStats['total'] ?? 0 }}</p>
                    <p class="text-sm text-gray-600">Total de Arquivos</p>
                </div>
                <div class="text-3xl text-blue-500">
                    <i class="fas fa-file-upload"></i>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-2 text-center">
                <div class="bg-green-100 p-2 rounded">
                    <p class="text-lg font-semibold text-green-600">{{ $uploadStats['completed'] ?? 0 }}</p>
                    <p class="text-xs text-gray-600">Concluídos</p>
                </div>
                <div class="bg-red-100 p-2 rounded">
                    <p class="text-lg font-semibold text-red-600">{{ $uploadStats['failed'] ?? 0 }}</p>
                    <p class="text-xs text-gray-600">Falhas</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('uploads.index') }}" class="text-blue-600 hover:underline text-sm">Ver todos os uploads →</a>
            </div>
        </div>
    </div>
    
    <!-- Card de Últimos Uploads -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-blue-600 text-white px-4 py-2">
            <h3 class="text-lg font-semibold">Últimos Uploads</h3>
        </div>
        <div class="p-4">
            @if(count($recentUploads ?? []) > 0)
                <ul class="divide-y divide-gray-200">
                    @foreach($recentUploads as $upload)
                    <li class="py-2">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm font-medium">{{ $upload->original_name }}</p>
                                <p class="text-xs text-gray-500">{{ $upload->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div>
                                @if($upload->status == 'completed')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Concluído
                                </span>
                                @elseif($upload->status == 'processing')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Processando
                                </span>
                                @elseif($upload->status == 'failed')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Falha
                                </span>
                                @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Pendente
                                </span>
                                @endif
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500 text-center py-4">Nenhum upload recente encontrado.</p>
            @endif
        </div>
    </div>
    
    <!-- Card de Ações Rápidas -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-blue-600 text-white px-4 py-2">
            <h3 class="text-lg font-semibold">Ações Rápidas</h3>
        </div>
        <div class="p-4">
            <div class="space-y-4">
                <a href="{{ route('uploads.create') }}" class="block w-full py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white rounded text-center">
                    Realizar Upload
                </a>
                <a href="{{ route('data.search') }}" class="block w-full py-2 px-4 bg-green-500 hover:bg-green-600 text-white rounded text-center">
                    Consultar Dados
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Gráfico de Atividade (Exemplo) -->
<div class="mt-8 bg-white rounded-lg shadow-md overflow-hidden">
    <div class="bg-blue-600 text-white px-4 py-2">
        <h3 class="text-lg font-semibold">Atividade Recente</h3>
    </div>
    <div class="p-4">
        <p class="text-gray-500 text-center py-4">Os gráficos de atividade serão exibidos aqui.</p>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endpush 