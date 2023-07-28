
<!-- resources/views/home.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Casa</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Casa</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        Você está logado!
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
