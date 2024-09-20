@extends('app.layout')

@section('content')
    <nav class="bg-gray-100">
        <ol class="flex space-x-4 text-gray-700">
            <li>
                <a href="{{route('home')}}" class="text-blue-600 hover:text-blue-800">Home</a>
            </li>
            <li>
                <span class="text-gray-500">/</span>
            </li>
            <li aria-current="page" class="text-gray-500">Conteúdo do Arquivo</li>
        </ol>
    </nav>

    <section id="historico-arquivo" class="mt-8">
        <h2 class="text-2xl font-semibold mb-4">Conteúdo do Arquivo</h2>

        <form action="" id="searchForm" method="GET" class="flex flex-wrap space-x-2">
            <input type="text" name="termo" value="{{ request()->input('termo') }}" placeholder="digite aqui sua busca" class="flex-grow p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-500">

            <select name="tipo" class="p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-500">
                <option value="">Tipo de busca</option>
                <option value="TckrSymb" {{ request()->input('tipo') === 'TckrSymb' ? 'selected' : '' }}>Buscar por Ativo Objeto</option>
                <option value="RptDt" {{ request()->input('tipo') === 'RptDt' ? 'selected' : '' }}>Buscar por Data</option>
            </select>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">Buscar</button>
        </form>


        <table class="min-w-full bg-white border border-gray-300 mt-4">
            <thead>
            <tr>
                <th class="border text-left px-4 py-2">Data</th>
                <th class="border text-left px-4 py-2">Ativo Objeto</th>
                <th class="border text-left px-4 py-2">Nome do Segmento</th>
                <th class="border text-left px-4 py-2">Papel</th>
                <th class="border text-left px-4 py-2">ISIN</th>
                <th class="border text-left px-4 py-2">Nome da Instituição</th>
            </tr>
            </thead>
            <tbody id="fileList"></tbody>
        </table>

        <div id="pagination" class="mt-4"></div>

    </section>

@endsection

@once
    @push('scripts')
        <script src="{{asset('js/conteudo.js')}}"></script>
    @endpush
@endonce
