@extends('app.layout')

@section('content')
    <nav class="bg-gray-100">
        <ol class="flex space-x-4 text-gray-700">
            <li>
                <a href="{{route('home')}}" class="text-blue-600 hover:text-blue-800">Home</a>
            </li>
            <li>
                <span class="text-gray-500">/</span>
            </li>
            <li aria-current="page" class="text-gray-500">Importar Arquivo</li>
        </ol>
    </nav>

    <section id="home" class="mt-4">
        <h2 class="text-2xl font-semibold mb-1">Importar Arquivo</h2>
        <p class="text-gray-700">Suba seus arquivos para processar.</p>

        <form id="uploadForm" class="mt-4 p-2 border border-gray-300 rounded">
            <div class="mb-4">
                <input type="file" id="fileInput" name="file" required>
            </div>
            <button type="submit" id="submitButton" class="bg-blue-500 text-white p-2 rounded mt-2">Enviar Arquivo</button>
        </form>
    </section>

    <p id="responseMessage" class="mt-4 text-gray-700"></p>
@endsection

@once
    @push('scripts')
        <script src="{{asset('js/importar-arquivo.js')}}"></script>
    @endpush
@endonce
