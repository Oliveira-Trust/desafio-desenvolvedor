import { redirectToLogin } from './auth.js';

let csrfCookieRequest = null;

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

function getCookie(name) {
    const cookies = document.cookie ? document.cookie.split('; ') : [];

    for (const cookie of cookies) {
        const [key, ...value] = cookie.split('=');

        if (key === name) {
            return decodeURIComponent(value.join('='));
        }
    }

    return null;
}

async function ensureCsrfCookie() {
    if (getCookie('XSRF-TOKEN')) {
        return;
    }

    if (!csrfCookieRequest) {
        csrfCookieRequest = fetch('/sanctum/csrf-cookie', {
            credentials: 'same-origin',
            headers: {
                Accept: 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
        }).finally(() => {
            csrfCookieRequest = null;
        });
    }

    await csrfCookieRequest;
}

export async function apiFetch(url, options = {}) {
    const { auth = false, headers = {}, ...rest } = options;
    const method = String(rest.method || 'GET').toUpperCase();
    const shouldSendCsrf = auth || !['GET', 'HEAD', 'OPTIONS'].includes(method);

    if (shouldSendCsrf) {
        await ensureCsrfCookie();
    }

    const csrfToken = getCookie('XSRF-TOKEN');

    const requestHeaders = {
        Accept: 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        ...headers,
    };

    if (csrfToken && !Object.keys(requestHeaders).some((header) => header.toLowerCase() === 'x-xsrf-token')) {
        requestHeaders['X-XSRF-TOKEN'] = csrfToken;
    }

    const response = await fetch(url, {
        ...rest,
        credentials: auth ? 'same-origin' : (rest.credentials ?? 'same-origin'),
        headers: requestHeaders,
    });

    const contentType = response.headers.get('content-type') || '';
    const payload = contentType.includes('application/json') ? normalizePayload(await response.json()) : null;

    if (response.status === 401) {
        redirectToLogin();
        throw new Error('Sessão expirada. Faça login novamente.');
    }

    return { response, data: payload };
}
