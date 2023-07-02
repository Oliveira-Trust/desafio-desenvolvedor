<html>
    <body>
        <p>Olá <strong>{{ $user->name }}!</strong></p>
        <p>Seguem os valores de conversão de moeda abaixo:</p>
        <p></p>
        
        @foreach ($data as $key => $value)
            <p><strong>{{$key}}:</strong> {{$value}}</p>
        @endforeach
        <p></p>
        
        <p>Att, <br>
        Washington Monteiro!</p>
    </body>
</html>
