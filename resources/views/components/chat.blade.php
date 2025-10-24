@php
    $isCs = auth()->user()->is_cs ?? false;
    $customers = $isCs ? \App\Models\User::where('is_cs', false)->get() : null;
@endphp


@if ($isCs)
    <div id="chat-container" class="fixed bottom-4 right-4 w-96 bg-white shadow-lg rounded-lg flex overflow-hidden z-50">
        <div class="w-32 bg-gray-50 border-r flex flex-col">
            <div class="px-2 py-2 font-bold border-b">Customer</div>
            <div id="chat-user-list" class="flex-1 overflow-y-auto">
                @foreach ($customers as $customer)
                    <div class="chat-user-item px-2 py-2 cursor-pointer hover:bg-blue-100"
                        data-user-id="{{ $customer->id }}">
                        <span class="font-semibold text-sm">{{ $customer->name }}</span>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex-1 flex flex-col">
            <div class="bg-gray-100 px-4 py-2 font-bold border-b">Customer Service Chat</div>
            <div id="chat-messages" class="flex-1 px-4 py-2 overflow-y-auto h-64"></div>
            <form id="chat-form" class="flex border-t">
                <input type="text" id="chat-input" class="flex-1 px-2 py-2 outline-none" placeholder="Ketik pesan..."
                    autocomplete="off" />
                <button type="submit" class="bg-[#ffd5b8] text-black px-4 py-2">Kirim</button>
            </form>
        </div>
    </div>
@else
    <div id="chat-fab" class="fixed bottom-6 right-6 z-50">
        <button id="open-chat-btn"
            class="w-16 h-16 rounded-full bg-[#ffddc5] shadow-lg flex items-center justify-center hover:bg-[#ffd5b8] transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8s-9-3.582-9-8a9 9 0 1118 0z" />
            </svg>
        </button>
    </div>
    <div id="chat-container"
        class="fixed bottom-6 right-6 w-80 bg-white shadow-lg rounded-lg flex flex-col overflow-hidden z-50 hidden">
        <div class="bg-gray-100 px-4 py-2 font-bold border-b flex items-center justify-between">
            <span>Customer Service Chat</span>
            <button id="close-chat-btn" class="text-gray-400 hover:text-gray-700 text-xl font-bold">&times;</button>
        </div>
        <div id="chat-messages" class="flex-1 px-4 py-2 overflow-y-auto h-64"></div>
        <form id="chat-form" class="flex border-t">
            <input type="text" id="chat-input" class="flex-1 px-2 py-2 outline-none" placeholder="Ketik pesan..."
                autocomplete="off" />
            <button type="submit" class="bg-[#ffd5b8] text-black px-4 py-2">Kirim</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openBtn = document.getElementById('open-chat-btn');
            const closeBtn = document.getElementById('close-chat-btn');
            const chatContainer = document.getElementById('chat-container');
            openBtn.addEventListener('click', function() {
                chatContainer.classList.remove('hidden');
            });
            closeBtn.addEventListener('click', function() {
                chatContainer.classList.add('hidden');
            });
        });
    </script>
@endif
