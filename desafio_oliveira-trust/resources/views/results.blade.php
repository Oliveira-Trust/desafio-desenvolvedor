<!-- resources/views/results.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Resultados do CSV</title>
</head>

<body>
    <h1>Historico de uploads</h1>
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