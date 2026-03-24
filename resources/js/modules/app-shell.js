import { apiFetch } from '../services/http';
import { redirectToLogin } from '../services/auth';

export function initAppShell() {
    const logoutButton = document.getElementById('logout-btn');

    if (!logoutButton) {
        return;
    }

    logoutButton.addEventListener('click', async () => {
        try {
            await apiFetch('/api/auth/logout', {
                method: 'POST',
                auth: true,
            });
        } catch (error) {
            // Logout deve prosseguir mesmo com falha de rede.
        } finally {
            redirectToLogin();
        }
    });
}
