@extends('layout')
@section('pagina_titulo', 'OliveiraStore - Alterar Senha' )

@section('pagina_conteudo')

<div class="container">
    <div class="row">
        <div class="col l10 offset-l1 s12 m12">
            <h4>Alterar Senha</h4>
            @if (session('status'))
                <div class="card-panel green">
                    {{ session('status') }}
                </div>
            @endif
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                @include('auth._form_email')
                @include('auth._form_password')
                @include('auth._form_password_confirm')

                <div class="row">
                    <button type="submit" class="btn red waves-effect waves-light col l6 m6 s12">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
