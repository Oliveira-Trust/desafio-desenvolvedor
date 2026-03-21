<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Search market data')</title>
    <style>
        :root {
            color-scheme: light;
            --bg: #f5f7fb;
            --surface: #ffffff;
            --text: #1d2433;
            --muted: #667085;
            --primary: #0052cc;
            --primary-hover: #003f9e;
            --border: #d0d7e2;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(circle at top left, #dbe7ff 0%, var(--bg) 52%);
            color: var(--text);
        }

        .topbar {
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 10;
            backdrop-filter: blur(4px);
            background: rgba(255, 255, 255, 0.9);
            border-bottom: 1px solid var(--border);
        }

        .topbar-inner {
            max-width: 1100px;
            margin: 0 auto;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .brand-group {
            display: flex;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
        }

        .brand {
            margin: 0;
            font-size: 1rem;
            font-weight: 700;
            color: var(--text);
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .nav-link {
            padding: 8px 12px;
            border-radius: 999px;
            color: var(--muted);
            text-decoration: none;
            font-size: 0.92rem;
            font-weight: 600;
            transition: background-color 0.2s, color 0.2s;
        }

        .nav-link:hover {
            background: #eef4ff;
            color: var(--primary);
        }

        .nav-link.active {
            background: #e8f0ff;
            color: var(--primary);
        }

        .logout-btn {
            border: 0;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.92rem;
            font-weight: 700;
            color: #fff;
            background: var(--primary);
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .logout-btn:hover {
            background: var(--primary-hover);
        }

        .page {
            min-height: calc(100vh - 61px);
            padding: 20px;
        }

        .page-inner {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .topbar-inner {
                align-items: flex-start;
                flex-direction: column;
            }

            .brand-group,
            .nav {
                width: 100%;
            }

            .logout-btn {
                width: 100%;
            }
        }
    </style>
    @stack('styles')
</head>
<body data-page="@yield('page')">
<header class="topbar">
    <div class="topbar-inner">
        <div class="brand-group">
            <p class="brand">Search market data</p>
            <nav class="nav" aria-label="Principal">
                <a
                    href="{{ route('uploads.page') }}"
                    class="nav-link {{ request()->routeIs('uploads.page') ? 'active' : '' }}"
                >
                    Upload
                </a>
                <a
                    href="{{ route('uploads.history') }}"
                    class="nav-link {{ request()->routeIs('uploads.history') ? 'active' : '' }}"
                >
                    Histórico
                </a>
            </nav>
        </div>
        <button id="logout-btn" class="logout-btn" type="button">Sair</button>
    </div>
</header>

<main class="page">
    <div class="page-inner">
        @yield('content')
    </div>
</main>

<script type="module" src="{{ asset('js/app.js') }}?v={{ filemtime(public_path('js/app.js')) }}"></script>
@stack('scripts')
</body>
</html>
