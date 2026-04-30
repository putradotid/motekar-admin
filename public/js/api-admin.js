const API_URL = 'http://127.0.0.1:8000';

function getToken() {
    return localStorage.getItem('admin_token'); // ← beda key
}

// redirect ke login admin
if (res.status === 401) {
    window.location.href = '/admin/login'; // ← beda redirect
}