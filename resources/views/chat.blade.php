<x-app-layout>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
      <div class="container mx-auto p-6 max-w-xl">
    <h1 class="text-3xl font-bold mb-4">Chat for Event: {{ $event->title }}</h1>

    <div id="messages" style="border: 1px solid #ccc; height: 300px; overflow-y: auto; background-color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
      <!-- Messages will appear here -->
    </div>

    <form id="chat-form" class="flex gap-2 mt-4">
      <input id="message-input" type="text" placeholder="Type message..." class="flex-grow border rounded px-3 py-2" autocomplete="off" required />
      <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded">Send</button>
    </form>
  </div>
  <script>
      document.addEventListener('DOMContentLoaded', () => {              const eventId = {{ $event->id }};
        const messagesDiv = document.getElementById('messages');
       const chatForm = document.getElementById('chat-form');
       const messageInput = document.getElementById('message-input');

      // Add message element
      function addMessage(message) {
      const div = document.createElement('div');
      div.textContent = `${message.user.name}: ${message.message}`;
      div.style.padding = '0.5rem';
      div.style.backgroundColor = '#e0f2fe';
      div.style.borderRadius = '0.5rem';
      div.style.marginBottom = '0.5rem';
      messagesDiv.appendChild(div);
      messagesDiv.scrollTop = messagesDiv.scrollHeight;
     }

     // Load existing messages this is the correct code block
      /*fetch(`/api/events/${eventId}/messages`, {
       headers: {
         'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
      },
      credentials: 'same-origin',
       })
      .then(res => res.json())
      .then(messages => {
      messages.forEach(addMessage);

     });*/
     //For testing static messeges added
    const testMessages = [
       { user: { name: 'Manager 3' }, message: 'need Test done by today' },
       { user: { name: 'Test account creation' }, message: 'done' }
     ];
     testMessages.forEach(addMessage);






      // Listen for new messages via Laravel Echo
        window.Echo.private(`event.${eventId}`)
       .listen('MessageSent', e => {
        addMessage(e.message);
       });

       // Send message form submit
     chatForm.addEventListener('submit', e => {
      e.preventDefault();
      const message = messageInput.value.trim();
      if (!message) return;

      axios.post(`/api/events/${eventId}/messages`, { message })
      .then(() => {
        messageInput.value = '';
       })
       .catch(() => {
        alert('Failed to send message');
          });
        });
      });
   </script>
</x-app-layout>
