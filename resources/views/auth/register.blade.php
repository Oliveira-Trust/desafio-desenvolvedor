@extends('layout')
@section('pagina_titulo', 'OliveiraStore - Cadastro de Usuário' )

@section('pagina_conteudo')

<div class="container">
    <div class="row">
        <div class="col l10 offset-l1 s12 m12">
            <h4>Cadastro de Usuário</h4>
            <form method="POST" action="{{ url('/register') }}">
                {{ csrf_field() }}

                <div class="row">
                    <div class="input-field">
                        <input id="name" type="text" name="name" value="{{ old('name') }}" class="validate {{ $errors->has('name') ? ' invalid' : '' }}" required autofocus>
                        <label for="name" data-error="{{ $errors->has('name') ? $errors->first('name') : null }}" >Nome</label>
                    </div>
                </div>

                @include('auth._form_email')
                @include('auth._form_password')
                @include('auth._form_password_confirm')

                <div class="row">
                    <button type="submit" class="btn red waves-effect waves-light col l6 m6 s12">
                        Cadastrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
