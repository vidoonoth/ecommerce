<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CS Chat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/chat.js'])
</head>
<body class="bg-gray-100 min-h-screen w-screen h-screen">
    @auth
        @php
            $recipientId = 'null';
            $isCs = auth()->user()->is_cs ?? false;
            $customers = $isCs ? \App\Models\User::where('is_cs', false)->get() : null;
        @endphp
        <script>
            window.Laravel = {
                user: @json(auth()->user()),
                chatRecipientId: {{ $recipientId }},
                pusherKey: '{{ config('broadcasting.connections.pusher.key') }}',
                pusherCluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}'
            };
        </script>
        <div class="w-full h-full flex bg-white shadow-lg overflow-hidden">
            <!-- Sidebar Customer List -->
            <div class="w-80 bg-gray-50 border-r flex flex-col h-full">
                <div class="px-6 py-6 font-bold text-xl border-b bg-white flex items-center justify-between">
                    <span>Customer</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold text-sm px-3 py-1 rounded transition">Logout</button>
                    </form>
                </div>
                <div id="chat-user-list" class="flex-1 overflow-y-auto">
                    @foreach($customers as $customer)
                        <div class="chat-user-item px-6 py-4 cursor-pointer hover:bg-blue-100 border-b flex items-center gap-3" data-user-id="{{ $customer->id }}">
                            <div class="w-10 h-10 bg-blue-200 rounded-full flex items-center justify-center font-bold text-blue-700 text-lg">{{ strtoupper(substr($customer->name,0,2)) }}</div>
                            <div class="flex flex-col">
                                <span class="font-semibold text-base">{{ $customer->name }}</span>
                                <span class="text-xs text-gray-500">{{ $customer->email }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Chat Area -->
            <div class="flex-1 flex flex-col h-full">
                <div class="bg-gray-100 px-8 py-6 font-bold text-xl border-b flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8s-9-3.582-9-8a9 9 0 1118 0z" /></svg>
                    Customer Service Chat
                </div>
                <div id="chat-messages" class="flex-1 px-8 py-6 overflow-y-auto h-full bg-white"></div>
                <form id="chat-form" class="flex border-t px-8 py-6 bg-gray-50">
                    <input type="text" id="chat-input" class="flex-1 px-4 py-3 outline-none border rounded-l-lg text-base" placeholder="Ketik pesan..." autocomplete="off" />
                    <button type="submit" class="bg-blue-500 text-white px-8 py-3 rounded-r-lg text-base font-semibold">Kirim</button>
                </form>
            </div>
        </div>
    @endauth
</body>
</html>
