<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name') }}</title>
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

        .bold {
            font-weight: bold;
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
        .label{
            font-weight:bolder  ;
        }
    </style>
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{url('icons/favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    @yield('styles')
</head>
<body class="c-app" >
@include('layouts.sidebar-new')
<div class="c-wrapper c-fixed-components">
    @include('layouts.content-main-header-new')
    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    @yield('content')
                </div>
            </div>
        </main>
        <footer class="c-footer">
            <div>
                <a href="https://coreui.io">CoreUI</a> &copy; 2020 creativeLabs.
            </div>
            <div class="ml-auto">Powered by&nbsp;<a href="https://coreui.io/">CoreUI</a>
            </div>
        </footer>
    </div>
</div>

<script src="{{url('dist/js/all.js')}}"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
<script>

    const onloadPage = async function () {
        const getCurrentUri = () => {
            const url = window.location.pathname.substring(1);
            const patt = /^\w[^\/]*?\/\w+[^\/]*?/ig;
            return url.match(patt);
        }
        const getMenuUrls = () => {
            return $("#sidebar").find('a').each(async function (i, m) {

                const curUri = await getCurrentUri();
                const href = $(m).prop('href');
                const patt = new RegExp(curUri, "g");
                if (href.match(patt)) {
                    $(m).addClass('c-active');
                    $(m).parent().parent().parent().addClass('c-show')
                }
                // console.log($(m).text())
            })
        }
        const exec = async () => {
            window.setTimeout(async function () {
                // console.log($("#sidebar .c-active").length);
                if ($("#sidebar .c-active").length) {
                    // console.log('mostra!')
                    getMenuUrls();

                } else {
                    // console.log('não mostra!')
                    getMenuUrls();
                    getCurrentUri();
                }
            }, 300);
        }
        await exec();
    }
</script>
@yield('scripts')
</body>
</html>
