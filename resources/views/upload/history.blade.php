@extends('layouts.template')

@section('title', 'Histórico de Uploads')

@push('styles')
<style>
    .history-layout {
        width: 100%;
        max-width: 1100px;
        display: grid;
        gap: 18px;
    }

    .hero-card,
    .table-card {
        background: #ffffff;
        border: 1px solid #d0d7e2;
        border-radius: 16px;
        box-shadow: 0 12px 40px rgba(15, 23, 42, 0.08);
    }

    .hero-card {
        padding: 24px 28px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
    }

    .hero-card h1 {
        margin: 0 0 8px;
        font-size: 1.7rem;
    }

    .hero-card p {
        margin: 0;
        color: #667085;
    }

    .hero-actions {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .select {
        border: 1px solid #d0d7e2;
        border-radius: 10px;
        padding: 10px 12px;
        background: #f8faff;
        color: #1d2433;
        font: inherit;
    }

    .table-card {
        overflow: hidden;
    }

    .table-header {
        padding: 18px 20px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }

    .table-header h2 {
        margin: 0;
        font-size: 1.05rem;
    }

    .table-header p {
        margin: 0;
        color: #667085;
        font-size: 0.92rem;
    }

    .status-note {
        min-height: 20px;
        color: #667085;
        font-size: 0.9rem;
    }

    .status-note.error {
        color: #b42318;
    }

    .table-wrapper {
        overflow-x: auto;
        padding: 18px 20px 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 860px;
    }

    th,
    td {
        text-align: left;
        padding: 14px 12px;
        border-bottom: 1px solid #e6ebf2;
        vertical-align: top;
    }

    th {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: #667085;
    }

    tbody tr:hover {
        background: #f8fbff;
    }

    .file-cell strong,
    .timestamp-cell strong {
        display: block;
        margin-bottom: 4px;
        color: #1d2433;
    }

    .muted {
        color: #667085;
        font-size: 0.88rem;
        word-break: break-word;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .badge.pending {
        background: #fff4cc;
        color: #946200;
    }

    .badge.processing {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .badge.completed {
        background: #dcfce7;
        color: #166534;
    }

    .badge.failed {
        background: #fee2e2;
        color: #b91c1c;
    }

    .empty-state {
        padding: 28px 20px 32px;
        text-align: center;
        color: #667085;
    }

    .pagination {
        padding: 0 20px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .pagination-meta {
        color: #667085;
        font-size: 0.92rem;
    }

    .pagination-nav {
        margin-left: auto;
    }

    .pagination-list {
        display: flex;
        align-items: center;
        gap: 0;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .page-item + .page-item .page-link {
        margin-left: -1px;
    }

    .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 12px;
        border: 1px solid #d0d7e2;
        background: #ffffff;
        color: #0052cc;
        font-size: 0.92rem;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
    }

    .page-item:first-child .page-link {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }

    .page-item:last-child .page-link {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .page-item.active .page-link {
        background: #0052cc;
        color: #ffffff;
        border-color: #0052cc;
        position: relative;
        z-index: 1;
    }

    .page-item.disabled .page-link {
        color: #98a2b3;
        background: #f8fafc;
        cursor: default;
    }

    @media (max-width: 768px) {
        .hero-card {
            padding: 20px;
            align-items: stretch;
            flex-direction: column;
        }

        .hero-actions {
            width: 100%;
            flex-direction: column;
            align-items: stretch;
        }

        .link-btn,
        .select {
            width: 100%;
        }

        .pagination {
            align-items: stretch;
        }

        .pagination-nav {
            width: 100%;
            margin-left: 0;
        }

        .pagination-list {
            justify-content: center;
            flex-wrap: wrap;
        }
    }
</style>
@endpush

@section('content')
<section class="history-layout">
    <div class="hero-card">
        <div>
            <h1>Histórico de uploads</h1>
            <p>Acompanhe status, paginação e timestamps dos arquivos enviados.</p>
        </div>

        <div class="hero-actions">
            <select id="per-page" class="select" aria-label="Itens por página">
                <option value="10">10 por página</option>
                <option value="25">25 por página</option>
                <option value="50">50 por página</option>
            </select>
        </div>
    </div>

    <div class="table-card">
        <div class="table-header">
            <div>
                <h2>Lista de arquivos enviados</h2>
                <p id="table-summary">Carregando histórico...</p>
            </div>

            <div id="status-note" class="status-note" aria-live="polite"></div>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Arquivo</th>
                        <th>Status</th>
                        <th>Tamanho</th>
                        <th>Caminho</th>
                        <th>Timestamps</th>
                    </tr>
                </thead>
                <tbody id="history-body"></tbody>
            </table>
            <div id="empty-state" class="empty-state" hidden>Nenhum upload encontrado.</div>
        </div>

        <div class="pagination">
            <div id="pagination-meta" class="pagination-meta"></div>
            <nav class="pagination-nav" aria-label="Paginas do histórico">
                <ul id="pagination-numbers" class="pagination-list"></ul>
            </nav>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    const historyBody = document.getElementById('history-body');
    const emptyState = document.getElementById('empty-state');
    const tableSummary = document.getElementById('table-summary');
    const statusNote = document.getElementById('status-note');
    const paginationMeta = document.getElementById('pagination-meta');
    const paginationNumbers = document.getElementById('pagination-numbers');
    const perPageSelect = document.getElementById('per-page');

    const state = {
        currentPage: 1,
        lastPage: 1,
        perPage: Number(perPageSelect.value),
        total: 0,
    };

    function formatDateTime(value) {
        if (!value) {
            return 'Nao processado';
        }

        const date = new Date(value);

        if (Number.isNaN(date.getTime())) {
            return value;
        }

        return new Intl.DateTimeFormat('pt-BR', {
            dateStyle: 'short',
            timeStyle: 'medium',
        }).format(date);
    }

    function formatSize(bytes) {
        if (!Number.isFinite(bytes) || bytes <= 0) {
            return '0 B';
        }

        const units = ['B', 'KB', 'MB', 'GB'];
        let size = bytes;
        let unitIndex = 0;

        while (size >= 1024 && unitIndex < units.length - 1) {
            size /= 1024;
            unitIndex += 1;
        }

        return `${size.toFixed(size >= 10 || unitIndex === 0 ? 0 : 1)} ${units[unitIndex]}`;
    }

    function getStatusLabel(status) {
        const labels = {
            pending: 'Pendente',
            processing: 'Processando',
            completed: 'Concluido',
            failed: 'Falhou',
        };

        return labels[status] || status;
    }

    function renderRows(items) {
        historyBody.innerHTML = '';

        if (!items.length) {
            emptyState.hidden = false;
            return;
        }

        emptyState.hidden = true;

        items.forEach((upload) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="file-cell">
                    <strong>${upload.filename}</strong>
                    <span class="muted">ID #${upload.id}</span>
                </td>
                <td>
                    <span class="badge ${upload.status}">${getStatusLabel(upload.status)}</span>
                </td>
                <td>${formatSize(Number(upload.size))}</td>
                <td class="muted">${upload.path}</td>
                <td class="timestamp-cell">
                    <strong>Criado:</strong>
                    <span class="muted">${formatDateTime(upload.created_at)}</span>
                    <strong>Atualizado:</strong>
                    <span class="muted">${formatDateTime(upload.updated_at)}</span>
                    <strong>Processado:</strong>
                    <span class="muted">${formatDateTime(upload.processed_at)}</span>
                </td>
            `;

            historyBody.appendChild(row);
        });
    }

    function getVisiblePages(currentPage, lastPage) {
        const maxVisible = 6;

        if (lastPage <= maxVisible) {
            return Array.from({ length: lastPage }, (_, index) => index + 1);
        }

        let start = Math.max(1, currentPage - 2);
        let end = start + maxVisible - 1;

        if (end > lastPage) {
            end = lastPage;
            start = end - maxVisible + 1;
        }

        return Array.from({ length: end - start + 1 }, (_, index) => start + index);
    }

    function renderPaginationNumbers() {
        paginationNumbers.innerHTML = '';

        const createPageItem = ({ label, page, disabled = false, active = false, ariaLabel = null }) => {
            const item = document.createElement('li');
            item.className = `page-item${disabled ? ' disabled' : ''}${active ? ' active' : ''}`;

            const button = document.createElement(active || disabled ? 'span' : 'button');
            button.className = 'page-link';
            button.textContent = label;

            if (ariaLabel) {
                button.setAttribute('aria-label', ariaLabel);
            }

            if (active) {
                button.setAttribute('aria-current', 'page');
            }

            if (!active && !disabled) {
                button.type = 'button';
                button.addEventListener('click', () => loadUploads(page));
            }

            item.appendChild(button);
            paginationNumbers.appendChild(item);
        };

        createPageItem({
            label: 'Anterior',
            page: state.currentPage - 1,
            disabled: state.currentPage <= 1,
            ariaLabel: 'Pagina anterior',
        });

        getVisiblePages(state.currentPage, state.lastPage).forEach((page) => {
            createPageItem({
                label: String(page),
                page,
                active: page === state.currentPage,
                ariaLabel: `Ir para pagina ${page}`,
            });
        });

        createPageItem({
            label: 'Próximo',
            page: state.currentPage + 1,
            disabled: state.currentPage >= state.lastPage,
            ariaLabel: 'Proxima pagina',
        });
    }

    function updatePagination(meta) {
        state.currentPage = meta.current_page;
        state.lastPage = meta.last_page;
        state.perPage = meta.per_page;
        state.total = meta.total;

        tableSummary.textContent = `${meta.total} upload(s) encontrados.`;
        paginationMeta.textContent = `Pagina ${meta.current_page} de ${meta.last_page}`;
        perPageSelect.value = String(meta.per_page);
        renderPaginationNumbers();
    }

    async function loadUploads(page = 1) {
        const token = localStorage.getItem('auth_token');

        if (!token) {
            window.location.href = '/login';
            return;
        }

        statusNote.textContent = 'Carregando...';
        statusNote.className = 'status-note';

        try {
            const response = await fetch(`/api/uploads?page=${page}&per_page=${state.perPage}`, {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}`,
                },
            });

            const result = await response.json();

            if (!response.ok) {
                if (response.status === 401) {
                    localStorage.removeItem('auth_token');
                    window.location.href = '/login';
                    return;
                }

                throw new Error(result.message || 'Nao foi possivel carregar o historico.');
            }

            renderRows(result.data || []);
            updatePagination(result.meta || {
                current_page: 1,
                last_page: 1,
                per_page: state.perPage,
                total: 0,
            });
            statusNote.textContent = '';
        } catch (error) {
            renderRows([]);
            tableSummary.textContent = 'Falha ao carregar o historico.';
            paginationMeta.textContent = '';
            paginationNumbers.innerHTML = '';
            statusNote.textContent = error.message || 'Erro inesperado ao carregar os uploads.';
            statusNote.className = 'status-note error';
        }
    }

    perPageSelect.addEventListener('change', () => {
        state.perPage = Number(perPageSelect.value);
        loadUploads(1);
    });

    loadUploads();
</script>
@endpush
