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

        .brand {
            margin: 0;
            font-size: 1rem;
            font-weight: 700;
            color: var(--text);
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
            display: grid;
            place-items: center;
            padding: 20px;
        }
    </style>
    @stack('styles')
</head>
<body>
<header class="topbar">
    <div class="topbar-inner">
        <p class="brand">Search market data</p>
        <button id="logout-btn" class="logout-btn" type="button">Sair</button>
    </div>
</header>

<main class="page">
    @yield('content')
</main>

<script>
    const authToken = localStorage.getItem('auth_token');

    if (!authToken) {
        window.location.href = '/login';
    }

    async function doLogout() {
        const token = localStorage.getItem('auth_token');

        try {
            if (token) {
                await fetch('/api/auth/logout', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}`,
                    },
                });
            }
        } catch (error) {
            // Logout deve prosseguir mesmo com falha de rede.
        } finally {
            localStorage.removeItem('auth_token');
            window.location.href = '/login';
        }
    }

    document.getElementById('logout-btn').addEventListener('click', doLogout);
</script>
@stack('scripts')
</body>
</html>
