@extends('layout')
@section('pagina_titulo', 'OliveiraStore - Recuperar Senha' )

@section('pagina_conteudo')

<div class="container">
    <div class="row">
        <div class="col l6 offset-l3 s12 m10 offset-m2">

            <h4>Recuperar Senha</h4>
            @if (session('status'))
                <div class="card-panel green">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ url('/password/email') }}">
                {{ csrf_field() }}

                @include('auth._form_email')

                <div class="row">
                    <button type="submit" class="btn red col l8 s12 m8">
                        Enviar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
