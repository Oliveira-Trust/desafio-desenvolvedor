@extends('layouts.template')

@section('title', 'dição de Usuário')

@section('content')

    <div class="container p-5">

        @if(session('danger'))
            <div class="alert alert-danger">{{ session('danger') }}</div>
        @endif

        <h2>Edição de Usuário</h2>

        <hr>

        <form method="POST" action="{{ route('user.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" required value="{{$user->name}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" required value="{{$user->email}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="access" class="col-md-4 col-form-label text-md-right">Tipo de Usuário</label>

                <div class="col-md-6">
                    <select name="access" id="access" class="form-control">
                        <option {{$user->access == 'USER' ? 'SELECTED' : ''}} value="USER">Usuário Comum</option>
                        <option {{$user->access == 'ADMIN' ? 'SELECTED' : ''}} value="ADMIN">Administrador</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password">
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirme sua senha') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>

    </div>

@endsection
