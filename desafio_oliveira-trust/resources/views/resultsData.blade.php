<!-- resources/views/results.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Resultados do CSV</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
    <h1>Dados consolidados</h1>
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
    {{ $data->appends(['search' => $searchTerm, 'search_by' => $searchBy, 'per_page' => $perPage])->links() }}
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
</body>

</html>