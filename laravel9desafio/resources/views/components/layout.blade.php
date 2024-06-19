<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Desafio Dev - {{ $title }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="{{ asset('css/fontawesome-free.all.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/OverlayScrollbars.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/adminlte.min.css?v=3.2.0') }}">

        <!-- Styles -->
        <style>
            
        </style>

        <style>
            
        </style>
    </head>
    <body class="dark-mode sidebar-mini layout-fixed layout-navbar-fixed" style="height: auto;">
		<div class="wrapper">		
            <nav class="main-header navbar navbar-expand navbar-dark">
                <ul class="navbar-nav">
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">Home</a>
                    </li>
                </ul>
            </nav>

            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="#" class="brand-link">
                    <span class="brand-text font-weight-light">Projeto Laravel</span>
                </a>
            </aside>

			<div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">{{ $title }}</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">{{ $breadcrumb }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                            <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif

				<section class="content">
                    <div class="container-fluid">
                        <div class="row">
							{{ $slot }}
                        </div>
                        @if (session('status'))
                            <div class="alert alert-warning">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </section>
			</div>
            
		</div>
	</body>
</html>
    