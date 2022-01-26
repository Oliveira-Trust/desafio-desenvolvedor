<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


    <title>Oliveira Trust - Desafio</title>
</head>
<body>
<section>
    <div class="container">
        <h1 class="h2">Registro de usuário</h1>
        <div class="row">
            <div class="col-md-6 offset-md-3">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('registro.user') }}" name="form-registro-usuario">
                    @csrf

                    {{-- Nome do usuário--}}
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="name" name="name" class="form-control" id="name">
                    </div>

                    {{-- E-Mail--}}
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input autocomplete="new-password" type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                    </div>

                    {{-- Senha --}}
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input autocomplete="new-password" type="password" name="password" class="form-control" id="password">
                    </div>

                    {{-- Confirmar Senha --}}
                    <div class="form-group">
                        <label for="confirm_password">Confirmar senha</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                    </div>


                    <div class="botoes">
                        <button type="button" class="btn btn-primary" onclick="window.location='{{ route('home') }}'">Voltar</button>
                        <button type="submit" class="btn btn-success">Registrar</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</body>
</html>
