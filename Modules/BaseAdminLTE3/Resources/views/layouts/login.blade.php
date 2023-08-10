<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    {{--META TAGS (Comuns a todos os Layouts --}}
    @include('baseadminlte3::layouts.partials.meta')
    {{--Carregamento CSS padrao--}}
    @stack('css')
    {{--Carregamento JS antes do Body--}}
    @stack('js-pre')
</head>
<body class="hold-transition login-page">
@yield('content')
{{--Carregamento JS depois do Body--}}
@stack('js')
</body>
</html>
