import { apiFetch } from '../services/http';
import { redirectToUpload } from '../services/auth';
import { clearFeedback, showFeedback } from '../utils/feedback';

function getLoginErrorMessage(data) {
    if (data?.code === 'AUTH_INVALID_CREDENTIALS') {
        return 'E-mail ou senha invalidos.';
    }

    if (data?.code === 'RATE_LIMITED') {
        return 'Muitas tentativas de login. Aguarde um instante e tente novamente.';
    }

    return data?.message || 'Nao foi possivel realizar o login.';
}

export function initLoginPage() {
    const form = document.getElementById('login-form');
    const submitButton = document.getElementById('submit-btn');
    const feedback = document.getElementById('feedback');

    if (!form || !submitButton || !feedback) {
        return;
    }

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        submitButton.disabled = true;
        clearFeedback(feedback);

        const payload = {
            email: form.email.value,
            password: form.password.value,
        };

        try {
            const { response, data } = await apiFetch('/api/auth/login', {
                method: 'POST',
                redirectOn401: false,
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(payload),
            });

            if (!response.ok) {
                showFeedback(feedback, getLoginErrorMessage(data), 'error');
                return;
            }

            showFeedback(feedback, data?.message || 'Login realizado com sucesso.', 'success');
            window.setTimeout(() => {
                redirectToUpload();
            }, 500);
        } catch (error) {
            showFeedback(feedback, 'Erro de conexão ao tentar autenticar.', 'error');
        } finally {
            submitButton.disabled = false;
        }
    });
}
