@extends('layouts.template')

@section('title', 'Perfil')

@section('content')

    <div class="container p-5">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('danger'))
            <div class="alert alert-danger">{{ session('danger') }}</div>
        @endif

        <h2>Meu Perfil</h2>

        <hr>

        <form method="post" action="{{route('user.change')}}" class="card-body">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Insira seu nome" value="{{$user->name}}">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Insira seu email" value="{{$user->email}}">
            </div>

            <div class="card">
                <div class="card-header">
                    Alteração de Senha
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="password">Insira sua Senha</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Insira sua senha">
                    </div>

                    <div class="form-group">
                        <label for="password_confirm">Confirme sua Senha</label>
                        <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Confirme sua senha">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-success mt-5">Salvar</button>
            </div>

        </form>

            <form action="{{route('user.delete')}}" method="post">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-md btn-outline-danger">Excluir minha conta</button>
            </form>

    </div>

@endsection
