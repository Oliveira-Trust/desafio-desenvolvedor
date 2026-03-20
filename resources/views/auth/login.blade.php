<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        .card {
            width: 100%;
            max-width: 420px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 28px;
            box-shadow: 0 12px 40px rgba(15, 23, 42, 0.08);
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
</head>
<body>
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

<script>
    const form = document.getElementById('login-form');
    const submitBtn = document.getElementById('submit-btn');
    const feedback = document.getElementById('feedback');

    if (localStorage.getItem('auth_token')) {
        window.location.href = '/upload';
    }

    function showMessage(message, type) {
        feedback.textContent = message;
        feedback.className = `message ${type}`;
    }

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        submitBtn.disabled = true;
        feedback.className = 'message';
        feedback.textContent = '';

        const payload = {
            email: form.email.value,
            password: form.password.value,
        };

        try {
            const response = await fetch('/api/auth/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(payload),
            });

            const result = await response.json();

            if (!response.ok) {
                const errorMessage = result.message || 'Não foi possível realizar o login.';
                showMessage(errorMessage, 'error');
                return;
            }

            const token = result?.data?.token;

            if (token) {
                localStorage.setItem('auth_token', token);
            }

            showMessage(result.message || 'Login realizado com sucesso.', 'success');
            window.setTimeout(() => {
                window.location.href = '/upload';
            }, 500);
        } catch (error) {
            showMessage('Erro de conexão ao tentar autenticar.', 'error');
        } finally {
            submitBtn.disabled = false;
        }
    });
</script>
</body>
</html>
