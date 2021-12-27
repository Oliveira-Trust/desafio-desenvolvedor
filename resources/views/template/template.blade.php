<!doctype html>
<html lang="pt-BR">
<head>
    @include('includes.head')
</head>
<body>
<div class="corpo">
    @include('includes.nav')

    @yield('content')

    @include('includes.footer')

    @include('includes.footer-scripts')

</div>
</body>
</html>
