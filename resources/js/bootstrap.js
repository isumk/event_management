import axios from 'axios';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY || '11435ea26d4cb69254d6', // real key from .env
    cluster: process.env.MIX_PUSHER_APP_CLUSTER || 'ap2',           // real cluster from .env
    encrypted: true,
});

window.axios = axios;

// Ensure CSRF token and headers are set if using Sanctum or session auth
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.withCredentials = true;

// Optionally, if you have CSRF token in meta tag:
const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}


