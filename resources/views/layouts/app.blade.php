<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'B3 Instruments') }} - @yield('title', 'Dashboard')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">

<div class="min-h-screen">

    {{-- Navigation --}}
    <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                {{-- Logo --}}
                <div class="flex items-center gap-6">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <svg class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span class="font-bold text-gray-800 text-lg">B3 Instruments</span>
                    </a>

                    <div class="hidden sm:flex gap-4">
                        <a href="{{ route('dashboard') }}"
                           class="text-sm font-medium px-3 py-1 rounded-md transition
                                      {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:text-gray-900' }}">
                            Uploads
                        </a>
                        <a href="{{ route('instruments.index') }}"
                           class="text-sm font-medium px-3 py-1 rounded-md transition
                                      {{ request()->routeIs('instruments.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:text-gray-900' }}">
                            Instrumentos
                        </a>
                    </div>
                </div>

                {{-- User menu --}}
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-600 hidden sm:block">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="text-sm text-gray-500 hover:text-red-600 transition font-medium">
                            Sair
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </nav>

    {{-- Page Content --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

</div>

</body>
</html>
