import { apiFetch } from '../services/http.js';

function formatDate(value, emptyLabel = '-') {
    if (!value) {
        return emptyLabel;
    }

    const date = new Date(value);

    if (Number.isNaN(date.getTime())) {
        return value;
    }

    return new Intl.DateTimeFormat('pt-BR', {
        dateStyle: 'short',
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

export function initUploadHistory() {
    const historyBody = document.getElementById('history-body');
    const emptyState = document.getElementById('empty-state');
    const tableSummary = document.getElementById('table-summary');
    const statusNote = document.getElementById('status-note');
    const paginationMeta = document.getElementById('pagination-meta');
    const paginationNumbers = document.getElementById('pagination-numbers');
    const filterForm = document.getElementById('filter-form');
    const filenameFilterInput = document.getElementById('filename-filter');
    const dateFilterInput = document.getElementById('date-filter');
    const clearFiltersButton = document.getElementById('clear-filters');
    const perPageSelect = document.getElementById('per-page');

    if (!historyBody || !emptyState || !tableSummary || !statusNote || !paginationMeta || !paginationNumbers || !filterForm || !filenameFilterInput || !dateFilterInput || !clearFiltersButton || !perPageSelect) {
        return;
    }

    const state = {
        currentPage: 1,
        lastPage: 1,
        perPage: Number(perPageSelect.value),
        total: 0,
        filename: '',
        date: '',
    };

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
                <td class="muted">${formatDate(upload.created_at, '-')}</td>
                <td class="muted">${formatDate(upload.processed_at, 'Nao processado')}</td>
            `;

            historyBody.appendChild(row);
        });
    }

    function buildPageItem({ label, page, disabled = false, active = false, ariaLabel = null }) {
        const item = document.createElement('li');
        item.className = `page-item${disabled ? ' disabled' : ''}${active ? ' active' : ''}`;

        const link = document.createElement(disabled || active ? 'span' : 'button');
        link.className = 'page-link';
        link.textContent = label;

        if (ariaLabel) {
            link.setAttribute('aria-label', ariaLabel);
        }

        if (active) {
            link.setAttribute('aria-current', 'page');
        }

        if (!disabled && !active) {
            link.type = 'button';
            link.addEventListener('click', () => {
                loadUploads(page);
            });
        }

        item.appendChild(link);
        return item;
    }

    function renderPaginationNumbers() {
        paginationNumbers.innerHTML = '';

        paginationNumbers.appendChild(buildPageItem({
            label: 'Anterior',
            page: state.currentPage - 1,
            disabled: state.currentPage <= 1,
            ariaLabel: 'Pagina anterior',
        }));

        getVisiblePages(state.currentPage, state.lastPage).forEach((page) => {
            paginationNumbers.appendChild(buildPageItem({
                label: String(page),
                page,
                active: page === state.currentPage,
                ariaLabel: `Ir para a pagina ${page}`,
            }));
        });

        paginationNumbers.appendChild(buildPageItem({
            label: 'Próxima',
            page: state.currentPage + 1,
            disabled: state.currentPage >= state.lastPage,
            ariaLabel: 'Próxima pagina',
        }));
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

    function buildQuery(page) {
        const params = new URLSearchParams({
            page: String(page),
            per_page: String(state.perPage),
        });

        if (state.filename) {
            params.set('filename', state.filename);
        }

        if (state.date) {
            params.set('date', state.date);
        }

        return params.toString();
    }

    async function loadUploads(page = 1) {
        statusNote.textContent = 'Carregando...';
        statusNote.className = 'status-note';

        try {
            const { response, data } = await apiFetch(`/api/uploads?${buildQuery(page)}`, {
                auth: true,
            });

            if (!response.ok) {
                throw new Error(data?.message || 'Nao foi possivel carregar o historico.');
            }

            renderRows(data?.data || []);
            updatePagination(data?.meta || {
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

    filterForm.addEventListener('submit', (event) => {
        event.preventDefault();
        state.filename = filenameFilterInput.value.trim();
        state.date = dateFilterInput.value;
        state.perPage = Number(perPageSelect.value);
        loadUploads(1);
    });

    clearFiltersButton.addEventListener('click', () => {
        filterForm.reset();
        state.filename = '';
        state.date = '';
        state.perPage = Number(perPageSelect.value);
        loadUploads(1);
    });

    perPageSelect.addEventListener('change', () => {
        state.perPage = Number(perPageSelect.value);
        loadUploads(1);
    });

    loadUploads();
}
