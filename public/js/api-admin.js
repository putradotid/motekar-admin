const API_URL = window.API_URL || 'http://127.0.0.1:8000';

function getToken() {
    return document.querySelector('meta[name="api-token"]')?.content || '';
}

function handleUnauthorized(status) {
    if (status === 401) {
        window.location.href = '/login';
    }
}