@extends('layouts.guest')

@section('title', 'Login')
@section('page', 'login')

@push('styles')
<style>
    .card {
        width: 100%;
        max-width: 420px;
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 28px;
        box-shadow: 0 12px 40px rgba(15, 23, 42, 0.08);
        margin: 0 auto;
    }

    h1 {
        margin: 0 0 8px;
        font-size: 1.65rem;
    }

    p {
        margin: 0 0 24px;
        color: var(--muted);
        font-size: 0.95rem;
    }

    form {
        display: grid;
        gap: 14px;
    }

    label {
        font-size: 0.88rem;
        font-weight: 600;
        display: block;
        margin-bottom: 6px;
    }

    input {
        width: 100%;
        border: 1px solid var(--border);
        border-radius: 10px;
        font-size: 1rem;
        padding: 11px 12px;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.15);
    }

    button {
        margin-top: 2px;
        border: 0;
        border-radius: 10px;
        padding: 12px;
        font-size: 1rem;
        font-weight: 700;
        color: #fff;
        background: var(--primary);
        cursor: pointer;
        transition: background-color 0.2s;
    }

    button:hover {
        background: var(--primary-hover);
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
    }

    .message.error {
        display: block;
        background: #ffe9e7;
        color: var(--error);
        border: 1px solid #ffccc7;
    }

    .message.success {
        display: block;
        background: #e7f8ef;
        color: var(--success);
        border: 1px solid #a6e4c5;
    }
</style>
@endpush

@section('content')
<main class="card">
    <h1>Acesse sua conta</h1>
    <p>Faça login para continuar.</p>

    <form id="login-form">
        <div>
            <label for="email">E-mail</label>
            <input id="email" name="email" type="email" autocomplete="email" required>
        </div>

        <div>
            <label for="password">Senha</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required>
        </div>

        <button type="submit" id="submit-btn">Entrar</button>
    </form>

    <div id="feedback" class="message" role="alert"></div>
</main>
@endsection
