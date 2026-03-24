import { apiFetch, getErrorMessage, getResponseMeta, getSuccessData } from '../services/http';

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

export function initMarketDataSearch() {
    const resultsBody = document.getElementById('market-data-body');
    const emptyState = document.getElementById('market-data-empty-state');
    const tableSummary = document.getElementById('market-data-table-summary');
    const statusNote = document.getElementById('market-data-status-note');
    const pagination = document.getElementById('market-data-pagination');
    const paginationMeta = document.getElementById('market-data-pagination-meta');
    const paginationNumbers = document.getElementById('market-data-pagination-numbers');
    const filterForm = document.getElementById('market-data-filter-form');
    const tickerFilterInput = document.getElementById('ticker-filter');
    const reportDateFilterInput = document.getElementById('report-date-filter');
    const clearFiltersButton = document.getElementById('clear-market-data-filters');
    const perPageSelect = document.getElementById('market-data-per-page');

    if (!resultsBody || !emptyState || !tableSummary || !statusNote || !pagination || !paginationMeta || !paginationNumbers || !filterForm || !tickerFilterInput || !reportDateFilterInput || !clearFiltersButton || !perPageSelect) {
        return;
    }

    const state = {
        currentPage: 1,
        lastPage: 1,
        perPage: Number(perPageSelect.value),
        total: 0,
        ticker: '',
        reportDate: '',
    };

    function renderRows(items) {
        resultsBody.innerHTML = '';

        if (!items.length) {
            emptyState.hidden = false;
            return;
        }

        emptyState.hidden = true;

        items.forEach((item) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${formatDate(item.RptDt)}</td>
                <td class="primary-cell">
                    <strong>${item.TckrSymb}</strong>
                </td>
                <td>${item.MktNm}</td>
                <td>${item.SctyCtgyNm}</td>
                <td class="muted">${item.ISIN}</td>
                <td>${item.CrpnNm}</td>
            `;

            resultsBody.appendChild(row);
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
                loadMarketData(page);
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
            label: 'Proxima',
            page: state.currentPage + 1,
            disabled: state.currentPage >= state.lastPage,
            ariaLabel: 'Proxima pagina',
        }));
    }

    function updateSummary(meta) {
        state.currentPage = Number(meta?.current_page ?? 1);
        state.lastPage = Number(meta?.last_page ?? 1);
        state.perPage = Number(meta?.per_page ?? state.perPage);
        state.total = Number(meta?.total ?? 0);
        perPageSelect.value = String(state.perPage);

        tableSummary.textContent = `${state.total} registro(s) encontrados.`;
        paginationMeta.textContent = `Pagina ${state.currentPage} de ${state.lastPage}`;
        pagination.hidden = false;
        renderPaginationNumbers();
    }

    function buildQuery(page) {
        const params = new URLSearchParams({
            page: String(page),
            per_page: String(state.perPage),
        });

        if (state.ticker) {
            params.set('TckrSymb', state.ticker);
        }

        if (state.reportDate) {
            params.set('RptDt', state.reportDate);
        }

        return params.toString();
    }

    async function loadMarketData(page = 1) {
        statusNote.textContent = 'Carregando...';
        statusNote.className = 'status-note';

        try {
            const query = buildQuery(page);
            const { response, data } = await apiFetch(`/api/market-data?${query}`, {
                auth: true,
            });

            if (!response.ok) {
                throw new Error(getErrorMessage(data) || 'Nao foi possivel carregar os registros.');
            }

            const items = getSuccessData(data) || [];

            renderRows(items);
            updateSummary(getResponseMeta(data) || {
                current_page: 1,
                last_page: 1,
                per_page: state.perPage,
                total: items.length,
            });
            statusNote.textContent = '';
        } catch (error) {
            renderRows([]);
            tableSummary.textContent = 'Falha ao carregar o market data.';
            paginationMeta.textContent = '';
            paginationNumbers.innerHTML = '';
            pagination.hidden = true;
            statusNote.textContent = error.message || 'Erro inesperado ao carregar os dados.';
            statusNote.className = 'status-note error';
        }
    }

    filterForm.addEventListener('submit', (event) => {
        event.preventDefault();
        state.ticker = tickerFilterInput.value.trim().toUpperCase();
        state.reportDate = reportDateFilterInput.value;
        state.perPage = Number(perPageSelect.value);
        loadMarketData(1);
    });

    clearFiltersButton.addEventListener('click', () => {
        filterForm.reset();
        state.ticker = '';
        state.reportDate = '';
        state.perPage = Number(perPageSelect.value);
        loadMarketData(1);
    });

    perPageSelect.addEventListener('change', () => {
        state.perPage = Number(perPageSelect.value);
        loadMarketData(1);
    });

    loadMarketData(1);
}
