<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="site-url" content="{{ url('/') }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @stack('styles')
    </head>

    <body class="painel">
        <div id="app">
            @include('layouts.nav')
            <main class="py-4">
                @include('layouts.back.alert-session')
                @yield('content')
            </main>
        </div>
        @include('layouts.back.toast')
        @include('layouts.back.modal')
    </body>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <script src="{{ asset('js/painel/helper.js') }}"></script>
    <script>
        var lang = {
            status: {
                0: '@lang("status.state.status.0")',
                1: '@lang("status.state.status.1")',
                2: '@lang("status.state.status.2")',
                3: '@lang("status.state.status.3")',
                4: '@lang("status.state.status.4")',
            },
            enable: {
                0: '@lang("status.state.enable.0")',
                1: '@lang("status.state.enable.1")',
            }
        }
    </script>
    @stack('scripts')

</html>