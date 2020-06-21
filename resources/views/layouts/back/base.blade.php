<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @stack('styles')
    </head>

    <body class="painel">
        <div id="app">
            @include('layouts.back.nav')
            <main class="py-4">
                @include('layouts.back.alert-session')
                @yield('content')
            </main>
        </div>
        @include('layouts.back.toast')
    </body>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <script src="{{ asset('js/painel/collapsedCustom.js') }}"></script>
    <script src="{{ asset('js/painel/formHelper.js') }}"></script>
    <script src="{{ asset('js/painel/toastHelper.js') }}"></script>
    @stack('scripts')

</html>