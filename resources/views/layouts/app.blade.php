<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="description" content="#">
        <meta name="keywords" content="#">
        <meta name="author" content="#">
    
        <meta property="og:url" content="" />
        <meta property="og:title" content="#" />
        <meta property="og:description" content="#" />
    
        <meta name="twitter:site" content="#" />
        <meta name="twitter:title" content="#" />
        <meta name="twitter:description" content="#" />

        <link rel="icon" href="/favicon.png"/>

        <title>{{ config('app.name', 'Conversor') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">


        @stack('head')

        @livewireStyles

    </head>
    <body class="font-sans antialiased">
        <div class="flex flex-col min-h-screen">
            
            @include('partials.navigation-menu')
            
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-screen-2xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="mb-auto pb-8">
                {{ $slot }}
            </main>

            
        </div>

        @stack('modals')
        
        @livewireScripts
        @stack('scripts_up')
        
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}"></script>
        @stack('scripts')
        
    </body>
</html>
