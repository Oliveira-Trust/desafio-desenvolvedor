@extends('layouts.template')

@section('title', 'Histórico de Uploads')
@section('page', 'upload-history')

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

    .select {
        border: 1px solid #d0d7e2;
        border-radius: 10px;
        padding: 10px 12px;
        background: #f8faff;
        color: #1d2433;
        font: inherit;
    }

    .input {
        border: 1px solid #d0d7e2;
        border-radius: 10px;
        padding: 10px 12px;
        background: #f8faff;
        color: #1d2433;
        font: inherit;
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
        }

        .select,
        .input,
        .filter-btn {
            width: 100%;
        }

        .filter-form {
            width: 100%;
            align-items: stretch;
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

        <form id="filter-form" class="filter-form hero-actions">
            <div class="filter-field">
                <label for="filename-filter">Nome do arquivo</label>
                <input id="filename-filter" class="input" type="text" placeholder="Ex.: InstrumentsConsolidatedFile">
            </div>

            <div class="filter-field">
                <label for="date-filter">Data de referência</label>
                <input id="date-filter" class="input" type="date">
            </div>

            <div class="filter-field">
                <label for="per-page">Itens por página</label>
                <select id="per-page" class="select" aria-label="Itens por página">
                    <option value="10">10 por página</option>
                    <option value="25">25 por página</option>
                    <option value="50">50 por página</option>
                </select>
            </div>

            <button type="submit" class="filter-btn primary">Filtrar</button>
            <button type="button" id="clear-filters" class="filter-btn secondary">Limpar</button>
        </form>
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
