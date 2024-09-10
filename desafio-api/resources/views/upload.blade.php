<!DOCTYPE html>
<html>
<head>
    <title>Teste de Upload e Busca</title>
</head>
<body>
<h1>Upload de Arquivo</h1>
@if (session('success'))
    <p>{{ session('success') }}</p>
@endif
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<form action="{{ url('api/upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="file">Escolha um arquivo CSV ou Excel:</label>
    <input type="file" name="file" id="file">
    <button type="submit">Enviar</button>
</form>

<h1>Histórico de Upload</h1>
<form action="{{ url('api/upload-history') }}" method="GET">
    <label for="filename">Nome do Arquivo:</label>
    <input type="text" name="filename" id="filename">
    <br>
    <label for="date">Data (YYYY-MM-DD):</label>
    <input type="date" name="date" id="date">
    <button type="submit">Buscar Histórico</button>
</form>

<h1>Buscar Conteúdo do Arquivo</h1>
<form action="{{ url('api/search-file') }}" method="GET">
    <label for="TckrSymb">TckrSymb:</label>
    <input type="text" name="TckrSymb" id="TckrSymb">
    <br>
    <label for="RptDt">RptDt:</label>
    <input type="date" name="RptDt" id="RptDt">
    <button type="submit">Buscar Conteúdo</button>
</form>
</body>
</html>
