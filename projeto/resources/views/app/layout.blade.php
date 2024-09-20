<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template com Tailwind CSS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- Header -->
<header class="bg-gray-800 text-white p-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-xl font-bold">FinTools</h1>
        <nav>
            <ul class="flex space-x-4 items-center">
                <li>
                    <a href="{{ route('home') }}"
                       class="{{ request()->routeIs('home') ? 'bg-white text-gray-800 font-bold py-2 px-4 rounded' : 'text-white hover:bg-gray-600 p-2 rounded' }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('importar.arquivo') }}"
                       class="{{ request()->routeIs('importar.arquivo') ? 'bg-white text-gray-800 font-bold py-2 px-4 rounded' : 'text-white hover:bg-gray-600 p-2 rounded' }}">
                        Importar Arquivo
                    </a>
                </li>
                <li>
                    <a href="{{ route('historico.arquivo') }}"
                       class="{{ request()->routeIs('historico.arquivo') ? 'bg-white text-gray-800 font-bold py-2 px-4 rounded' : 'text-white hover:bg-gray-600 p-2 rounded' }}">
                        Histórico de Arquivo
                    </a>
                </li>
                <!-- Logout Button -->
                <li>
                    <a href="{{ route('logout') }}"
                       class="text-white hover:bg-gray-600 p-2 rounded flex items-center space-x-2">
                        <span class="hidden md:inline">Sair</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<!-- Main content -->
<main class="container mx-auto p-4">
    @yield('content')
</main>

</body>

@stack('scripts')
</html>
