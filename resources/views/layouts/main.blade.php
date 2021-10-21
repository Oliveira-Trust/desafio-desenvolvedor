<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ route('historic') }}">Histórico</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ route('taxes') }}">Dashboard</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" ></script>
    @yield('scripts')
</body>
</html>
