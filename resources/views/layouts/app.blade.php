<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    :class="{ 'dark': darkMode }"
    x-data="{ darkMode: $persist(false) }"
>

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>@stack('title')</title>

    <!-- Fonts -->
    <link
        href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap"
        rel="stylesheet"
    >

    <script>
        if (localStorage._x_darkMode === 'true' || (!('_x_darkMode' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add("dark")
        } else {
            document.documentElement.classList.remove("dark")
        }
    </script>

    @wireUiScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('scripts')
</head>

<body class="antialiased">
    @auth
        <main class="flex min-h-screen flex-col items-center">
            <x-header />
            <div class="flex w-full max-w-screen-xl flex-1 p-4 sm:mx-auto md:p-6">
                <div class="w-full rounded-md bg-white p-4 shadow-lg dark:bg-gray-800 md:p-6">
                    {{ $slot }}
                </div>
            </div>
        </main>
    @endauth

    @guest
        {{ $slot }}
    @endguest

    @livewireScripts
    @livewire('notifications')
</body>

</html>
