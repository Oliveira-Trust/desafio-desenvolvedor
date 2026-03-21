@extends('layouts.template')

@section('title', 'Upload de Arquivos')

@push('styles')
<style>
    .upload-layout {
        width: 100%;
        max-width: 1100px;
        display: grid;
        grid-template-columns: minmax(0, 1.6fr) minmax(280px, 0.9fr);
        gap: 18px;
        align-items: start;
    }

    .card,
    .info-card {
        background: #ffffff;
        border: 1px solid #d0d7e2;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 12px 40px rgba(15, 23, 42, 0.08);
    }

    h1 {
        margin: 0 0 8px;
        font-size: 1.8rem;
    }

    p {
        margin: 0 0 18px;
        color: #667085;
    }

    .hint {
        font-size: 0.88rem;
        margin-bottom: 18px;
    }

    form {
        display: grid;
        gap: 14px;
    }

    input[type="file"] {
        width: 100%;
        border: 1px dashed #d0d7e2;
        border-radius: 10px;
        padding: 12px;
        background: #fafcff;
    }

    button {
        border: 0;
        border-radius: 10px;
        padding: 12px;
        font-size: 1rem;
        font-weight: 700;
        color: #fff;
        background: #0052cc;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    button:hover {
        background: #003f9e;
    }

    button:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .message {
        margin-top: 16px;
        padding: 10px 12px;
        border-radius: 10px;
        font-size: 0.92rem;
        display: none;
        white-space: pre-line;
    }

    .message.error {
        display: block;
        background: #ffe9e7;
        color: #d92d20;
        border: 1px solid #ffccc7;
    }

    .message.success {
        display: block;
        background: #e7f8ef;
        color: #027a48;
        border: 1px solid #a6e4c5;
    }

    .eyebrow {
        display: inline-flex;
        margin-bottom: 12px;
        padding: 6px 10px;
        border-radius: 999px;
        background: #e8f0ff;
        color: #0052cc;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .hero-copy {
        margin-bottom: 24px;
    }

    .hero-copy p {
        margin-bottom: 10px;
    }

    .info-card h2 {
        margin: 0 0 12px;
        font-size: 1.15rem;
    }

    .info-list {
        display: grid;
        gap: 12px;
        margin: 0 0 22px;
    }

    .info-item {
        padding: 14px 16px;
        border-radius: 12px;
        background: #f8fbff;
        border: 1px solid #e1e9f5;
    }

    .info-item strong {
        display: block;
        margin-bottom: 4px;
        color: #1d2433;
    }

    .info-item span {
        color: #667085;
        font-size: 0.92rem;
    }

    .link-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 12px 14px;
        border-radius: 10px;
        border: 1px solid #b9cdf8;
        background: #eef4ff;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
    }

    .link-btn:hover {
        background: #dfeaff;
    }

    @media (max-width: 900px) {
        .upload-layout {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<section class="upload-layout">
    <div class="card">
        <span class="eyebrow">Operação</span>
        <div class="hero-copy">
            <h1>Enviar novo arquivo</h1>
            <p>Centralize aqui os arquivos CSV e Excel que serão processados pela aplicação.</p>
            <p class="hint">Formatos permitidos: <strong>.csv</strong>, <strong>.xls</strong>, <strong>.xlsx</strong>.</p>
        </div>

        <form id="upload-form">
            <input
                id="file"
                name="file"
                type="file"
                accept=".csv,.xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/csv"
                required
            >
            <button type="submit" id="submit-btn">Enviar arquivo</button>
        </form>

        <div id="feedback" class="message" role="alert"></div>
    </div>

    <aside class="info-card">
        <h2>Acompanhar processamento</h2>
        <div class="info-list">
            <div class="info-item">
                <strong>Histórico paginado</strong>
                <span>Veja os envios recentes com navegação por página.</span>
            </div>
            <div class="info-item">
                <strong>Status do upload</strong>
                <span>Acompanhe itens pendentes, processando, concluídos ou com falha.</span>
            </div>
            <div class="info-item">
                <strong>Timestamps</strong>
                <span>Consulte criação, atualização e processamento de cada arquivo.</span>
            </div>
        </div>

        <a href="{{ route('uploads.history') }}" class="link-btn">Abrir histórico de uploads</a>
    </aside>
</section>
@endsection

@push('scripts')
<script>
    const form = document.getElementById('upload-form');
    const fileInput = document.getElementById('file');
    const submitBtn = document.getElementById('submit-btn');
    const feedback = document.getElementById('feedback');
    const allowedExtensions = ['csv', 'xls', 'xlsx'];
    const allowedMimeTypes = [
        'text/csv',
        'application/csv',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'text/plain'
    ];

    function showMessage(message, type) {
        feedback.textContent = message;
        feedback.className = `message ${type}`;
    }

    function getExtension(fileName) {
        const parts = fileName.split('.');
        return parts.length > 1 ? parts.pop().toLowerCase() : '';
    }

    function isAllowedFile(file) {
        const extension = getExtension(file.name);
        if (!allowedExtensions.includes(extension)) {
            return false;
        }

        // Alguns navegadores não preenchem file.type para certos arquivos.
        return !file.type || allowedMimeTypes.includes(file.type.toLowerCase());
    }

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const token = localStorage.getItem('auth_token');
        if (!token) {
            showMessage('Token não encontrado. Faça login novamente.', 'error');
            return;
        }

        const file = fileInput.files[0];
        if (!file) {
            showMessage('Selecione um arquivo para continuar.', 'error');
            return;
        }

        if (!isAllowedFile(file)) {
            showMessage('Formato inválido. Envie apenas arquivos .csv, .xls ou .xlsx.', 'error');
            return;
        }

        submitBtn.disabled = true;
        feedback.className = 'message';
        feedback.textContent = '';

        const formData = new FormData();
        formData.append('file', file);

        try {
            const response = await fetch('/api/uploads', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}`,
                },
                body: formData,
            });

            const result = await response.json();

            if (!response.ok) {
                if (response.status === 401) {
                    localStorage.removeItem('auth_token');
                    showMessage('Sessão expirada. Faça login novamente.', 'error');
                    window.setTimeout(() => {
                        window.location.href = '/login';
                    }, 900);
                    return;
                }

                const errorMessage = result.message || 'Não foi possível enviar o arquivo.';
                showMessage(errorMessage, 'error');
                return;
            }

            const message = result?.data?.message || 'Upload realizado com sucesso.';
            const fileName = result?.data?.upload?.filename ? `\nArquivo: ${result.data.upload.filename}` : '';
            showMessage(`${message}${fileName}`, 'success');
            form.reset();
        } catch (error) {
            showMessage('Erro de conexão ao tentar enviar o arquivo.', 'error');
        } finally {
            submitBtn.disabled = false;
        }
    });
</script>
@endpush
