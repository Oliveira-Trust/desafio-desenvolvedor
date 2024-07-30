<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div class="flex w-full sm:max-w-md gap-5 items-center justify-center">
                <a href="/" wire:navigate>
                    <img src="/assets/images/logo.png" alt="Conversor de Moedas" class="w-[60px] h-[60px]">
                </a>
                <h1 class="dark:text-white text-2xl font-semibold">Conversor de Moedas</h1>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>

            @if (request()->routeIs('login'))
                <a
                    href="{{ route('register') }}"
                    class="rounded-md px-3 py-2 mt-10 font-semibold text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white/80 dark:hover:text-white dark:focus-visible:ring-white"
                >
                    Cadastre-se
                </a>
            @endif
        </div>
    </body>
</html>
