@extends('app.layout')

@section('content')
    <section id="home" class="mt-2">
        <h2 class="text-2xl font-semibold mb-1">Bem-vindo, {{auth()->user()->name}}</h2>
        <p class="text-gray-700">Aqui você pode ver dados consolidados.</p>

        <div class="mt-5">
            <table class="min-w-full bg-white border border-gray-300 mt-4">
                <thead>
                <tr>
                    <th class="border px-4 py-2">Nome do Arquivo</th>
                    <th class="border px-4 py-2">Data de Criação</th>
                    <th class="border px-4 py-2">Ver Conteúdo</th>
                </tr>
                </thead>
                <tbody id="fileList"></tbody>
            </table>

            <div id="pagination" class="mt-4">

            </div>
        </div>
    </section>


{{--    <form action="{{ url('/consolidated') }}" method="GET">--}}
{{--        <div class="form-group">--}}
{{--            <input type="text" name="search" value="{{ request()->input('search') }}" placeholder="Buscar" class="form-control">--}}
{{--            <select name="search_by" class="form-control mt-2">--}}
{{--                <option value="TckrSymb" {{ request()->input('search_by') === 'TckrSymb' ? 'selected' : '' }}>Buscar por TckrSymb</option>--}}
{{--                <option value="RptDt" {{ request()->input('search_by') === 'RptDt' ? 'selected' : '' }}>Buscar por RptDt</option>--}}
{{--            </select>--}}
{{--            <button type="submit" class="btn btn-primary mt-2">Buscar</button>--}}

{{--            <select name="per_page" class="form-control mt-2">--}}
{{--                <option value="10" {{ request()->input('per_page') == 10 ? 'selected' : '' }}>10 por página</option>--}}
{{--                <option value="50" {{ request()->input('per_page') == 50 ? 'selected' : '' }}>50 por página</option>--}}
{{--                <option value="100" {{ request()->input('per_page') == 100 ? 'selected' : '' }}>100 por página</option>--}}
{{--                <option value="500" {{ request()->input('per_page') == 500 ? 'selected' : '' }}>500 por página</option>--}}
{{--                <option value="1000" {{ request()->input('per_page') == 500 ? 'selected' : '' }}>1000 por página</option>--}}
{{--            </select>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--    @if($data)--}}
{{--        {{ $data->appends(['search' => $searchTerm, 'search_by' => $searchBy, 'per_page' => $perPage])->links() }}--}}
{{--    @endif--}}
{{--    <table border="1">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            @foreach($header as $column)--}}
{{--                <th>{{ $column }}</th>--}}
{{--            @endforeach--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}

{{--        @foreach($data as $row)--}}
{{--            <tr>--}}
{{--                @foreach($row as $cell)--}}
{{--                    <td>{{ $cell }}</td>--}}
{{--                @endforeach--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
@endsection

@once
    @push('scripts')
        <script src="{{asset('js/arquivos.js')}}"></script>
    @endpush
@endonce
