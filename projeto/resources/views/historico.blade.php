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
            <li aria-current="page" class="text-gray-500">Histórico Arquivo</li>
        </ol>
    </nav>

    <section id="historico-arquivo" class="mt-8">
        <h2 class="text-2xl font-semibold mb-4">Histórico de Arquivo</h2>
        <p class="text-gray-700">Veja o histórico dos arquivos importados.</p>
        <ul class="list-disc list-inside">
            <li class="text-gray-600">Arquivo 1 - 12/09/2024</li>
            <li class="text-gray-600">Arquivo 2 - 11/09/2024</li>
        </ul>
    </section>

    <form action="{{ url('/consolidated') }}" method="GET">
        <div class="form-group">
            <input type="text" name="search" value="{{ request()->input('search') }}" placeholder="Buscar" class="form-control">
            <select name="search_by" class="form-control mt-2">
                <option value="TckrSymb" {{ request()->input('search_by') === 'TckrSymb' ? 'selected' : '' }}>Buscar por TckrSymb</option>
                <option value="RptDt" {{ request()->input('search_by') === 'RptDt' ? 'selected' : '' }}>Buscar por RptDt</option>
            </select>
            <button type="submit" class="btn btn-primary mt-2">Buscar</button>

            <select name="per_page" class="form-control mt-2">
                <option value="10" {{ request()->input('per_page') == 10 ? 'selected' : '' }}>10 por página</option>
                <option value="50" {{ request()->input('per_page') == 50 ? 'selected' : '' }}>50 por página</option>
                <option value="100" {{ request()->input('per_page') == 100 ? 'selected' : '' }}>100 por página</option>
                <option value="500" {{ request()->input('per_page') == 500 ? 'selected' : '' }}>500 por página</option>
                <option value="1000" {{ request()->input('per_page') == 500 ? 'selected' : '' }}>1000 por página</option>
            </select>
        </div>
    </form>
    @if($data)
        {{ $data->appends(['search' => $searchTerm, 'search_by' => $searchBy, 'per_page' => $perPage])->links() }}
    @endif
    <table border="1">
        <thead>
        <tr>
            @foreach($header as $column)
                <th>{{ $column }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>

        @foreach($data as $row)
            <tr>
                @foreach($row as $cell)
                    <td>{{ $cell }}</td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
