import { clearAuthToken, getAuthToken, redirectToLogin } from './auth';

function normalizePayload(payload) {
    if (!payload || typeof payload !== 'object' || Array.isArray(payload)) {
        return payload;
    }

    if (!payload.error || typeof payload.error !== 'object') {
        return payload;
    }

    return {
        ...payload,
        message: payload.error.message || payload.message,
        code: payload.error.code || payload.code,
        details: payload.error.details || payload.details,
    };
}

export async function apiFetch(url, options = {}) {
    const { auth = false, headers = {}, ...rest } = options;

    const requestHeaders = {
        Accept: 'application/json',
        ...headers,
    };

    if (auth) {
        const token = getAuthToken();

        if (!token) {
            redirectToLogin();
            throw new Error('Token não encontrado. Faça login novamente.');
        }

        requestHeaders.Authorization = `Bearer ${token}`;
    }

    const response = await fetch(url, {
        ...rest,
        headers: requestHeaders,
    });

    const contentType = response.headers.get('content-type') || '';
    const payload = contentType.includes('application/json') ? normalizePayload(await response.json()) : null;

    if (response.status === 401) {
        clearAuthToken();
        redirectToLogin();
        throw new Error('Sessão expirada. Faça login novamente.');
    }

    return { response, data: payload };
}
