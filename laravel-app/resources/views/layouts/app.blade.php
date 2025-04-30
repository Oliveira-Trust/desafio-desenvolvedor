<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sistema de Processamento de Dados Financeiros' }}</title>
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Estilos adicionais -->
    <style>
        [x-cloak] { display: none !important; }
    </style>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex flex-col min-h-screen">
        <!-- Cabeçalho -->
        <header class="bg-blue-600 text-white shadow-md">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold">Sistema Financeiro</a>
                
                @auth
                <nav class="hidden md:block">
                    <ul class="flex space-x-6">
                        <li><a href="{{ route('dashboard') }}" class="hover:text-blue-200">Dashboard</a></li>
                        <li><a href="{{ route('uploads.index') }}" class="hover:text-blue-200">Uploads</a></li>
                        <li><a href="{{ route('data.search') }}" class="hover:text-blue-200">Consultar Dados</a></li>
                    </ul>
                </nav>
                
                <div class="flex items-center space-x-4">
                    <span>Olá, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm bg-blue-700 px-3 py-1 rounded hover:bg-blue-800">Sair</button>
                    </form>
                </div>
                @else
                <div>
                    <a href="{{ route('login') }}" class="text-sm bg-blue-700 px-3 py-1 rounded hover:bg-blue-800 mr-2">Entrar</a>
                </div>
                @endauth
            </div>
        </header>
        
        <!-- Conteúdo principal -->
        <main class="flex-grow container mx-auto px-4 py-8">
            @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
            @endif
            
            @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p>{{ session('error') }}</p>
            </div>
            @endif
            
            @yield('content')
        </main>
        
        <!-- Rodapé -->
        <footer class="bg-gray-800 text-white py-6">
            <div class="container mx-auto px-4 text-center">
                <p>&copy; {{ date('Y') }} Sistema de Processamento de Dados Financeiros</p>
            </div>
        </footer>
    </div>
    
    @stack('scripts')
</body>
</html> 