@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Novo Upload</h1>
    <a href="{{ route('uploads.index') }}" class="text-blue-600 hover:text-blue-800">
        ← Voltar para a lista
    </a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="p-6">
        <form action="{{ route('uploads.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p class="font-bold">Erro ao enviar arquivo:</p>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <div class="mb-6">
                <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                    Arquivo (CSV ou Excel)
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="file" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                <span>Clique para selecionar um arquivo</span>
                                <input id="file" name="file" type="file" class="sr-only" accept=".csv,.xlsx,.xls">
                            </label>
                        </div>
                        <p class="text-xs text-gray-500">
                            Arquivos CSV ou Excel (máx. 100MB)
                        </p>
                        <p id="selected-file" class="text-sm text-gray-900 mt-2 hidden">
                            Nenhum arquivo selecionado
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="mb-6">
                <label for="reference_date" class="block text-sm font-medium text-gray-700 mb-2">
                    Data de Referência (opcional)
                </label>
                <input type="date" name="reference_date" id="reference_date" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                <p class="mt-1 text-sm text-gray-500">
                    Data de referência dos dados contidos no arquivo.
                </p>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Enviar Arquivo
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('file');
        const fileLabel = document.getElementById('selected-file');
        
        fileInput.addEventListener('change', function() {
            if (fileInput.files.length > 0) {
                fileLabel.textContent = fileInput.files[0].name;
                fileLabel.classList.remove('hidden');
            } else {
                fileLabel.textContent = 'Nenhum arquivo selecionado';
                fileLabel.classList.add('hidden');
            }
        });
    });
</script>
@endpush 