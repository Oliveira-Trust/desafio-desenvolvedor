<p>Olá, {{ $history->user->name }}.</p>

<p>Houve um erro ao processar o arquivo de instrumentos: <strong>{{ $history->file_name }}</strong>.</p>

<p><strong>Detalhes da falha:</strong></p>
<blockquote style="background: #eee; padding: 10px; border-left: 5px solid #ff0000;">
    {{ $errorMessage }}
</blockquote>

<p><strong>Dados do Upload:</strong></p>
<ul>
    <li>ID do Processamento: #{{ $history->id }}</li>
    <li>Data de Referência: {{ $history->reference_date }}</li>
</ul>

<p>Por favor, verifique o arquivo e tente realizar o upload novamente. Se o erro persistir, entre em contato com o suporte informando o ID acima.</p>

<hr>
<p><small>Este é um e-mail automático do sistema TrustFlow.</small></p>