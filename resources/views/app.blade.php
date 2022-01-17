<!DOCTYPE html>
<html>
<head>
    <title>Agência de Câmbio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @import 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/css/bootstrap.min.css'; 

       .funkyradio div {
           float: left;
           margin: 5px;
       }

       .funkyradio label {
       width: 100%;
       border-radius: 3px;
       border: 1px solid #D1D3D4;
       font-weight: normal;
       }

       .funkyradio input[type="radio"]:empty,
       .funkyradio input[type="checkbox"]:empty {
       display: none;
       }

       .funkyradio input[type="radio"]:empty ~ label,
       .funkyradio input[type="checkbox"]:empty ~ label {
       position: relative;
       line-height: 2.5em;
       text-indent: 3.25em;
       margin-top: 2em;
       cursor: pointer;
       -webkit-user-select: none;
           -moz-user-select: none;
           -ms-user-select: none;
               user-select: none;
       }

       .funkyradio input[type="radio"]:empty ~ label:before,
       .funkyradio input[type="checkbox"]:empty ~ label:before {
       position: absolute;
       display: block;
       top: 0;
       bottom: 0;
       left: 0;
       content: '';
       width: 2.5em;
       background: #D1D3D4;
       border-radius: 3px 0 0 3px;
       }

       .funkyradio input[type="radio"]:hover:not(:checked) ~ label,
       .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label {
       color: #888;
       }

       .funkyradio input[type="radio"]:hover:not(:checked) ~ label:before,
       .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label:before {
       content: '\2714';
       text-indent: .9em;
       color: #C2C2C2;
       }

       .funkyradio input[type="radio"]:checked ~ label,
       .funkyradio input[type="checkbox"]:checked ~ label {
       color: #777;
       }

       .funkyradio input[type="radio"]:checked ~ label:before,
       .funkyradio input[type="checkbox"]:checked ~ label:before {
       content: '\2714';
       text-indent: .9em;
       color: #333;
       background-color: #ccc;
       }

       .funkyradio input[type="radio"]:focus ~ label:before,
       .funkyradio input[type="checkbox"]:focus ~ label:before {
       box-shadow: 0 0 0 3px #999;
       }

       .funkyradio-default input[type="radio"]:checked ~ label:before,
       .funkyradio-default input[type="checkbox"]:checked ~ label:before {
       color: #333;
       background-color: #ccc;
       }

       .funkyradio-primary input[type="radio"]:checked ~ label:before,
       .funkyradio-primary input[type="checkbox"]:checked ~ label:before {
       color: #fff;
       background-color: #337ab7;
       }

       .funkyradio-success input[type="radio"]:checked ~ label:before,
       .funkyradio-success input[type="checkbox"]:checked ~ label:before {
       color: #fff;
       background-color: #5cb85c;
       }

       .funkyradio-danger input[type="radio"]:checked ~ label:before,
       .funkyradio-danger input[type="checkbox"]:checked ~ label:before {
       color: #fff;
       background-color: #d9534f;
       }

       .funkyradio-warning input[type="radio"]:checked ~ label:before,
       .funkyradio-warning input[type="checkbox"]:checked ~ label:before {
       color: #fff;
       background-color: #f0ad4e;
       }

       .funkyradio-info input[type="radio"]:checked ~ label:before,
       .funkyradio-info input[type="checkbox"]:checked ~ label:before {
       color: #fff;
       background-color: #5bc0de;
       }
   </style>

</head>

<body>

    <nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
        <div class="container">
            <a class="navbar-brand mr-auto" href="{{route('dashboard')}}">Agência de Câmbio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register-user') }}">Cadastrar</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Câmbio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('history') }}">Historico</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('settings') }}">Configuracao</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('signout') }}">Sair</a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')

</body>

@yield('javascript')

</html>