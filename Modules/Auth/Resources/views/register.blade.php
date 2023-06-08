@extends('layouts.common.main')

@section('title', 'Cadastro - Serviço de Câmbio')

@section('content')
    <div class="col-md-6">
        <h1 class="text-center">Cadastre-se abaixo</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" class="form-control" id="name" required>
                @if ($errors->get('name'))
                    @include('components.common.input-errors', ['errors' => $errors->get('name')])
                @endif
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" id="email" required>
                @if ($errors->get('email'))
                    @include('components.common.input-errors', ['errors' => $errors->get('email')])
                @endif
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" name="password" class="form-control" id="password" required>
                @if ($errors->get('password'))
                    @include('components.common.input-errors', ['errors' => $errors->get('password')])
                @endif
            </div>
            <div class="mb-3">
                <label for="password-confirmation" class="form-label">Confirmar Senha</label>
                <input type="password" name="password_confirmation" class="form-control" id="password-confirmation" required>
                @if ($errors->get('password_confirmation'))
                    @include('components.common.input-errors', ['errors' => $errors->get('password_confirmation')])
                @endif
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>
@endsection
