@extends('layouts.app')
@section('content')
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="container py-4">
            <div class="p-5 mb-4 bg-light rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">Cotação de Moedas</h1>
                    @auth
                        <a href="{{route('form-conversion') }}" class="btn btn-secondary btn-lg">Realizar Cotação</a>
                        <a href="{{ route('history') }}" class="btn btn-info btn-lg">Histórico de Cotações</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-info btn-lg">Entrar</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-secondary btn-lg">Registrar</a>
                        @endif
                    @endauth

                </div>
            </div>


            <footer class="pt-3 mt-4 text-muted border-top">
                Geanne M. Santos
            </footer>
        </div>
    </div>
@endsection
