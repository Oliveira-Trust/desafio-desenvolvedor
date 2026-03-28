<h1>Olá, {{ $history->user->name }}!</h1>
<p>O processamento do arquivo <strong>{{ $history->file_name }}</strong> foi concluído com sucesso.</p>

<ul>
    <li><strong>Data de Referência:</strong> {{ $history->reference_date->format('d/m/Y') }}</li>
    <li><strong>Total de Registros:</strong> {{ number_format($history->total_rows, 0, ',', '.') }}</li>
    <li><strong>Status:</strong> {{ ucfirst($history->status) }}</li>
</ul>

<p>Os dados já estão disponíveis para consulta na plataforma.</p>