@include('layouts.sb-admin-2.cabecalho')
<body class="bg-gradient-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@include('layouts.sb-admin-2.javascript')
</body>
</html>
