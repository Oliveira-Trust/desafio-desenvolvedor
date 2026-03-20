@extends('layouts.template')

@section('title', 'Upload de Arquivos')

@push('styles')
<style>
    .card {
        width: 100%;
        max-width: 560px;
        background: #ffffff;
        border: 1px solid #d0d7e2;
        border-radius: 14px;
        padding: 28px;
        box-shadow: 0 12px 40px rgba(15, 23, 42, 0.08);
    }

    h1 {
        margin: 0 0 8px;
        font-size: 1.65rem;
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
</style>
@endpush

@section('content')
<section class="card">
    <h1>Upload de Arquivos</h1>
    <p>Envie apenas arquivos Excel ou CSV.</p>
    <p class="hint">Formatos permitidos: <strong>.csv</strong>, <strong>.xls</strong>, <strong>.xlsx</strong>.</p>

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
            const fileName = result?.data?.file_name ? `\nArquivo: ${result.data.file_name}` : '';
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
