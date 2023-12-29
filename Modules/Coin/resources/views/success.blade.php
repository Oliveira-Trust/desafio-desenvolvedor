@extends('layouts.app')

@section('content')
    @if (Route::has('login'))
        @auth
            <div class="container-md">
                <div class="alert alert-success" role="alert">
                    Cotação gravada com sucesso!
                </div>
                <div>
                    <a class="btn btn-success" href="{{ url('/') }}">Cotar novamente</a>
                </div>
            </div>
        @else
            <div class="alert alert-warning container-sm" role="alert">
                Você não esta logado
            </div>
            @endauth
            </div>
        @endif

        @endsection