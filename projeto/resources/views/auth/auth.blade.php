<!DOCTYPE html>
<html lang="pt-br" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#1a1a1a">
    <meta NAME="RATING" CONTENT="general">
    <meta NAME="DISTRIBUTION" CONTENT="global">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;900&display=swap" rel="stylesheet">

    <!-- CSS only -->
    <link href="{{ url('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>

<div class="form-signin-center">
    <main class="form-signin">
        <form action="{{ route('login-post') }}" method="post">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Insira suas credenciais</h1>

            <div class="form-floating">
                {{--<input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">--}}
                <input id="surname" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                       value="{{ old('email') }}" placeholder="name@example.com" required>
                <label for="floatingInput">Email</label>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                       id="floatingPassword" placeholder="Password" value="{{ old('password') }}" required>
                <label for="floatingPassword">Senha</label>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="checkbox mb-3" style="margin-top: 10px;">
                <label>
                    <input type="checkbox" value="remember-me"> Lembre-me
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
        </form>
    </main>

    @if(isset($messages))
        <div style="width: 80%; margin: auto">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $messages }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>
