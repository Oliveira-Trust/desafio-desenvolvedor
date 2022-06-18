<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <title>Cotação em tempo real</title>
    <link rel="shortcut icon" href="/cash.png">
    <meta name="description" content="Cotação de moeda em tempo real">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="/css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <script src="/js/materialize.min.js"></script>

</head>



@yield('css-view')



</head>


<body>

    @yield('conteudo-view')


    @yield('js-view')



</body>
</html>