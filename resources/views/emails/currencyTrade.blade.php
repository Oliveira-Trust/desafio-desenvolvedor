<!DOCTYPE html>
<html>
<head>
    <title>Oliveira Trust</title>
</head>

<body>
    <h1>Cotação de compra de moeda estrangeira</h1>

    <h2>Detalhes da cotação</h2>

    @foreach($fields as $key => $val)
        <p><b>{{ $key }}:</b> {{ $val }}</p>
    @endforeach

    <p>Obrigado pela confiança!</p>

</body>

</html>