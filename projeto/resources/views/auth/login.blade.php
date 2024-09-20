<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="w-full max-w-sm md:max-w-md bg-white rounded-lg shadow-md p-8 md:p-10">
    <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Login</h2>

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-3" role="alert">
            <strong class="font-bold">Erro!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-3" role="alert">
            <strong class="font-bold">Erro!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{route('auth')}}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="email" class="block text-sm text-gray-600">E-mail</label>
            <input type="email" id="email" name="email" placeholder="digite o e-mail" value="{{old('email')}}"
                   class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   required>
        </div>
        <div class="mb-6">
            <label for="password" class="block text-sm text-gray-600">Senha</label>
            <input type="password" id="password" name="password" placeholder="digite a senha"
                   value="{{old('password')}}"
                   class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   required>
        </div>
        <div>
            <button type="submit"
                    class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                Entrar
            </button>
        </div>
    </form>

    <div class="mt-6 flex justify-between items-center text-gray-600">
        <div>
            <p><span><strong>Email:</strong> </span>test@example.com</p>
            <p><span><strong>Password:</strong> </span>password</p>
        </div>
        <button onclick="fillCredentials()" class="text-blue-500 hover:text-blue-700">
            <!-- Ícone de copiar e colar -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
            </svg>
        </button>
    </div>

</div>
</body>

<script>
    function fillCredentials() {
        const email = 'test@example.com';
        const password = 'password';

        document.getElementById('email').value = email;
        document.getElementById('password').value = password;
    }
</script>
</html>
