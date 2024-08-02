<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo ao Projeto de Conversão de Moeda</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-custom {
            background-image: url('https://www.cpomagazine.com/wp-content/uploads/2023/02/what-u-s-companies-can-learn-from-the-european-payment-scene_1500.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-custom bg-gray-100 bg-opacity-70">
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900">Projeto de Conversão de Moeda</h1>
            @if (Route::has('login'))
                <nav class="flex space-x-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="text-gray-800 hover:text-gray-600 transition duration-300"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="text-gray-800 hover:text-gray-600 transition duration-300"
                        >
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="text-gray-800 hover:text-gray-600 transition duration-300"
                            >
                                Registre-se
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </header>

    <main class="flex items-center justify-center min-h-screen">
        <div class="text-center bg-white bg-opacity-80 p-8 rounded-lg shadow-lg">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Bem-vindo ao Projeto de Conversão de Moeda</h2>
            <p class="text-lg text-gray-700 mb-8">Um projeto inovador para facilitar a conversão entre diferentes moedas com precisão e facilidade.</p>
            <a
                href="{{ route('conversion.conversion') }} "
                class="bg-blue-500 text-white px-6 py-3 rounded-md shadow-lg hover:bg-blue-600 transition duration-300"
            >
                Iniciar Conversão
            </a>
        </div>
    </main>
</body>
</html>
