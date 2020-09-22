@extends('layout')
@section('pagina_titulo', 'OliveiraStore - Login' )

@section('pagina_conteudo')

<div class="container">
    <div class="row">
        <div class="col l6 offset-l3 s12 m10 offset-m2">
            
            <h4>Login</h4>
            <form method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                @include('auth._form_email')
                @include('auth._form_password')

                <div class="row">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}} id="remember" />
                    <label for="remember">Lembre-se de Mim</label>
                </div>

                <div class="row">
                    <button type="submit" class="btn red col l8 s12 m8">
                        Entrar
                    </button>
                </div>

                <div class="row">
                    <a class="" href="{{ url('/password/reset') }}">
                        Esqueceu Sua Senha?
                    </a>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection
