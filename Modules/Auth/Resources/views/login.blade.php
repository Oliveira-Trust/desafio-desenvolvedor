@extends('layouts.common.main')

@section('title', 'Entrar - Serviço de Câmbio')

@section('content')
    <div class="col-md-6">
        <h1 class="text-center">Entrar</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
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
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Entrar</button>
            </div>
        </form>
    </div>
@endsection
