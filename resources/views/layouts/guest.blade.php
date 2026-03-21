<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login')</title>
    <style>
        :root {
            color-scheme: light;
            --bg: #f4f7fb;
            --card: #ffffff;
            --text: #1d2433;
            --muted: #667085;
            --primary: #0052cc;
            --primary-hover: #003f9e;
            --border: #d0d7e2;
            --error: #d92d20;
            --success: #027a48;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(circle at top right, #dbe7ff 0%, var(--bg) 55%);
            color: var(--text);
            display: grid;
            place-items: center;
            padding: 20px;
        }
    </style>
    @stack('styles')
</head>
<body data-page="@yield('page')">
    @yield('content')
    <script type="module" src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
