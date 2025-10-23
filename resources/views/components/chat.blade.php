<div id="chat-container"
    class="fixed bottom-4 right-4 w-80 bg-white shadow-lg rounded-lg flex flex-col overflow-hidden z-50">
    <div class="bg-gray-100 px-4 py-2 font-bold border-b">Customer Service Chat</div>
    <div id="chat-messages" class="flex-1 px-4 py-2 overflow-y-auto h-64"></div>
    <form id="chat-form" class="flex border-t">
        <input type="text" id="chat-input" class="flex-1 px-2 py-2 outline-none" placeholder="Ketik pesan..."
            autocomplete="off" />
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Kirim</button>
    </form>
</div>
<script src="/js/chat.js"></script>
