
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: window.Laravel.pusherKey,
    cluster: window.Laravel.pusherCluster,
    forceTLS: true,
});


const userId = window.Laravel.user.id;
let recipientId = window.Laravel.chatRecipientId;
let echoListeners = [];

function fetchMessages() {
    if (!recipientId || recipientId === 'null') return;
    fetch(`/chat?recipient_id=${recipientId}`)
        .then(res => res.json())
        .then(messages => {
            const chatMessages = document.getElementById('chat-messages');
            chatMessages.innerHTML = '';
            messages.forEach(msg => {
                const div = document.createElement('div');
                div.className = msg.user_id === userId ? 'text-right mb-2' : 'text-left mb-2';
                div.innerHTML = `<span class='inline-block px-3 py-2 rounded ${msg.user_id === userId ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800'}'>${msg.message}</span>`;
                chatMessages.appendChild(div);
            });
            chatMessages.scrollTop = chatMessages.scrollHeight;
        });
}

function resetListeners() {
    echoListeners.forEach(l => l.stopListening('ChatMessageSent'));
    echoListeners = [];
    if (!recipientId || recipientId === 'null') return;
    echoListeners.push(window.Echo.private(`chat.${userId}.${recipientId}`)
        .listen('ChatMessageSent', (e) => {
            fetchMessages();
        })
    );
    echoListeners.push(window.Echo.private(`chat.${recipientId}.${userId}`)
        .listen('ChatMessageSent', (e) => {
            fetchMessages();
        })
    );
}

document.getElementById('chat-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const input = document.getElementById('chat-input');
    const message = input.value.trim();
    if (!message || !recipientId || recipientId === 'null') return;
    fetch('/chat', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ recipient_id: recipientId, message })
    }).then(() => {
        input.value = '';
        fetchMessages();
    });
});

if (document.getElementById('chat-user-list')) {
    document.querySelectorAll('.chat-user-item').forEach(item => {
        item.addEventListener('click', function() {
            recipientId = this.getAttribute('data-user-id');
            fetchMessages();
            resetListeners();
        });
    });
}

if (recipientId && recipientId !== 'null') {
    fetchMessages();
    resetListeners();
}
