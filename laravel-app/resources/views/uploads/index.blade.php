@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Histórico de Uploads</h1>
    <a href="{{ route('uploads.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
        Novo Upload
    </a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nome Original
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Data de Referência
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Registros
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Criado em
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($uploads as $upload)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $upload->id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $upload->original_name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $upload->reference_date ? $upload->reference_date->format('d/m/Y') : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
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
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $upload->total_records ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $upload->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('uploads.show', $upload->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Detalhes</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                        Nenhum upload encontrado.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $uploads->links() }}
    </div>
</div>
@endsection 