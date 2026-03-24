@extends('layouts.template')

@section('title', 'Busca de Market Data')
@section('page', 'market-data-index')

@push('styles')
<style>
    .market-data-layout {
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
        display: grid;
        gap: 18px;
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
        align-items: end;
        gap: 12px;
    }

    .filter-form {
        display: flex;
        align-items: end;
        gap: 12px;
        flex-wrap: wrap;
    }

    .filter-field {
        display: grid;
        gap: 6px;
    }

    .filter-field label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #344054;
    }

    .select,
    .input {
        border: 1px solid #d0d7e2;
        border-radius: 10px;
        padding: 10px 12px;
        background: #f8faff;
        color: #1d2433;
        font: inherit;
    }

    .input {
        min-width: 220px;
    }

    .filter-btn {
        border: 0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.92rem;
        font-weight: 700;
        cursor: pointer;
    }

    .filter-btn.primary {
        background: #0052cc;
        color: #ffffff;
    }

    .filter-btn.secondary {
        background: #eef4ff;
        color: #0052cc;
        border: 1px solid #b9cdf8;
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

    .primary-cell strong {
        display: block;
        margin-bottom: 4px;
        color: #1d2433;
    }

    .muted {
        color: #667085;
        font-size: 0.88rem;
        word-break: break-word;
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

    .page-item.active .page-link {
        background: #0052cc;
        border-color: #0052cc;
        color: #ffffff;
    }

    .page-item.disabled .page-link {
        color: #98a2b3;
        background: #f8fafc;
        cursor: not-allowed;
    }

    @media (max-width: 768px) {
        .hero-card,
        .table-header,
        .table-wrapper,
        .pagination {
            padding-left: 16px;
            padding-right: 16px;
        }

        .hero-actions,
        .filter-form {
            width: 100%;
        }

        .filter-field,
        .input,
        .select,
        .filter-btn {
            width: 100%;
        }

        .pagination-nav {
            margin-left: 0;
            width: 100%;
        }

        .pagination-list {
            flex-wrap: wrap;
        }
    }
</style>
@endpush

@section('content')
<section class="market-data-layout">
    <div class="hero-card">
        <div>
            <h1>Buscar market data</h1>
            <p>Consulte os registros ja processados a partir dos uploads realizados.</p>
        </div>

        <form id="market-data-filter-form" class="filter-form">
            <div class="filter-field">
                <label for="ticker-filter">Ticker</label>
                <input
                    id="ticker-filter"
                    name="TckrSymb"
                    class="input"
                    type="text"
                    placeholder="Ex.: PETR4"
                    autocomplete="off"
                >
            </div>

            <div class="filter-field">
                <label for="report-date-filter">Data de referencia</label>
                <input
                    id="report-date-filter"
                    name="RptDt"
                    class="input"
                    type="date"
                >
            </div>

            <div class="filter-field">
                <label for="market-data-per-page">Itens por pagina</label>
                <select id="market-data-per-page" class="select" name="per_page">
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>

            <div class="hero-actions">
                <button type="submit" class="filter-btn primary">Buscar</button>
                <button type="button" id="clear-market-data-filters" class="filter-btn secondary">Limpar</button>
            </div>
        </form>
    </div>

    <div class="table-card">
        <div class="table-header">
            <div>
                <h2>Resultados</h2>
                <p id="market-data-table-summary">Listagem paginada dos registros ingeridos.</p>
            </div>
            <div id="market-data-status-note" class="status-note" aria-live="polite"></div>
        </div>

        <div class="table-wrapper">
            <table aria-describedby="market-data-table-summary">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Ticker</th>
                        <th>Mercado</th>
                        <th>Categoria</th>
                        <th>ISIN</th>
                        <th>Nome corporativo</th>
                    </tr>
                </thead>
                <tbody id="market-data-body"></tbody>
            </table>
        </div>

        <div id="market-data-empty-state" class="empty-state" hidden>
            Nenhum registro encontrado para os filtros informados.
        </div>

        <div id="market-data-pagination" class="pagination">
            <div id="market-data-pagination-meta" class="pagination-meta"></div>
            <nav class="pagination-nav" aria-label="Paginacao de market data">
                <ul id="market-data-pagination-numbers" class="pagination-list"></ul>
            </nav>
        </div>
    </div>
</section>
@endsection
