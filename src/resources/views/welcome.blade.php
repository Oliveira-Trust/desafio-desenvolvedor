<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Application</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="flex items-center justify-between flex-wrap bg-gray-200 p-6">
        <div class="flex items-center flex-shrink-0 text-gray-800 mr-6">
            <span class="font-semibold text-xl tracking-tight">Meu Site</span>
        </div>
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Registrar</a>
            @endif
        </div>
    </nav>

    <!-- Conteúdo da página -->
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Bem-vindo à página inicial do Laravel Application!
                </div>
            </div>
        </div>
    </div>
</body>
</html>
