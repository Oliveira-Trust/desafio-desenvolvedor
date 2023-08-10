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
<body class="layout-top-nav">
@stack('body-pre')
<div class="wrapper">
    {{--Header--}}
    @yield('header')
    {{--Sidebar--}}
    @yield('main-sidebar')
    <div class="content-wrapper pb-1">
        {{--Page Header--}}
        @yield('page_header')
        <section class="content">
            {{--Content--}}
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>
    {{--Footer--}}
    @yield('footer')
    @yield('control-sidebar')
</div>
{{--Carregamento JS depois do Body--}}
@stack('js')
</body>
</html>
