// public/js/api.js
const API_URL = 'http://127.0.0.1:8000/api';

function getToken() {
    return localStorage.getItem('token');
}

async function apiFetch(endpoint, options = {}) {
    const res = await fetch(API_URL + endpoint, {
        ...options,
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            ...(getToken() && { Authorization: 'Bearer ' + getToken() }),
            ...(options.headers || {}),
        },
    });

    let data;
    try { data = await res.json(); } catch { data = { message: 'Invalid JSON' }; }

    if (res.status === 401) {
        localStorage.removeItem('token');
        window.location.href = '/login';
        return;
    }

    if (!res.ok) throw data;

    return data;
}

const api = {
    get: (url) => apiFetch(url),
    post: (url, body) => apiFetch(url, { method: 'POST', body: JSON.stringify(body) }),
};