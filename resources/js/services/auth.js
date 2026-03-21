const AUTH_TOKEN_KEY = 'auth_token';

export function getAuthToken() {
    return localStorage.getItem(AUTH_TOKEN_KEY);
}

export function setAuthToken(token) {
    localStorage.setItem(AUTH_TOKEN_KEY, token);
}

export function clearAuthToken() {
    localStorage.removeItem(AUTH_TOKEN_KEY);
}

export function redirectToLogin() {
    window.location.href = '/login';
}

export function redirectToUpload() {
    window.location.href = '/upload';
}

export function ensureAuthenticated() {
    if (!getAuthToken()) {
        redirectToLogin();
        return false;
    }

    return true;
}
