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
            const closeBtn = document.getElementById('close-chat-btn');
            const chatContainer = document.getElementById('chat-container');
            if (closeBtn && chatContainer) {
                closeBtn.addEventListener('click', function() {
                    chatContainer.classList.add('hidden');
                });
            }
        });
    </script>
@endif
