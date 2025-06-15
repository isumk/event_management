import './bootstrap';

import Alpine from 'alpinejs';
import Echo from 'laravel-echo';
import axios from 'axios';

function sendMessage(eventId, messageContent) {
    axios.post(`/api/events/${eventId}/messages`, {
        message: messageContent
    })
    .then(response => {
        console.log('Message sent:', response.data);
    })
    .catch(error => {
        console.error('Error sending message:', error);
    });
}


window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,  // Laravel 12 uses Vite; .env variables prefixed with VITE_
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    encrypted: true,
});
var channel = Echo.channel('my-channel');
channel.listen('.my-event', function(data) {
  alert(JSON.stringify(data));
});
window.Echo.private(`event.${eventId}`)
    .listen('MessageSent', (e) => {
        console.log('New message received:', e.message);
        // Add code to update your chat UI with e.message
    });


window.Alpine = Alpine;

Alpine.start();
