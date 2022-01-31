<head>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name') }}</title>
    <link href="{{url('dist/css/style.css')}}" rel="stylesheet">
    <link href="{{url('dist/css/style.css')}}" rel="stylesheet">
    <style>
        .pagination {
            margin-bottom: 0;
        }

        .form-control {
            border: 0;
            border-bottom: 1px solid;
            border-radius: 0;
        }

        .card, .btn, .pagination, .c-header {
            border-radius: 0;
            border: unset;
            box-shadow: 1px 4px 5px -1px #bbbbbb;
        }

        .c-app .btn-info {
            color: #fff;
            background-color: #4ab35ceb;
            border-color: #4ab35ceb;
        }

        .c-app .btn-primary {
            color: #fff;
            background-color: #1698f5b3;
            border-color: #1698f5b3;
        }

        .c-app .btn-warning {
            color: #4f5d73;
            background-color: #f99e15a3;
            border-color: #f99e15a3;
        }

        .c-app .list-border {
            border-left: 0;
            border-right: 0;
            border-top: 0;
        }

        .table {
            max-width: 99%;
            margin: auto;
        }

        td.actions {
            text-align: center;

        }

        .card h1 {
            font-size: 1.53125rem;
        }
    </style>
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{url('icons/favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    @yield('styles')
</head>
<body class="c-app">

<div class="c-wrapper c-fixed-components">
    <div class="c-body">
        <main class="c-main">

            <div class="container-fluid">
                <div class="fade-in">

                    @yield('content')
                </div>
            </div>
        </main>

    </div>
</div>


</body>
</html>
