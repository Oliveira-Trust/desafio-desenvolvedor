@extends('layouts.front.base')

@section('content')
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
    <div class="top-right links">
        @auth
        <a href="{{ route('painel') }}">Painel</a>
        @else
        <a href="{{ route('login') }}">Login</a>

        @if (Route::has('register'))
        <a href="{{ route('register') }}">Criar Conta</a>
        @endif
        @endauth
    </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            Portal com<br/>CRUD e API
        </div>
        <h3 class="lead">
            Desafio Desenvolvedor
        </h3>
    </div>
</div>
@endsection