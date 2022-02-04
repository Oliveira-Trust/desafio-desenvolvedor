<!DOCTYPE html>
<html>
<head>
    <title>Cotação de Moeda</title>
</head>
<body>
    <h1>Cotação </h1>
    <table cellpadding="0" cellspacing="0">
    @foreach ($cotacao['dados'] as $item)
        <tr>
            <td>{{ $item }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>