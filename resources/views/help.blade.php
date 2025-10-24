<x-app-layout>
    <div class="w-fit mx-8 my-8">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Help & Support') }}
        </h2>
    </div>

    <div class="">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">Welcome to our Help Center!</h3>
                    <p class="mb-4">Here you can find answers to common questions and get support.</p>

                    <div class="mb-6">
                        <h4 class="text-xl font-semibold mb-2">Frequently Asked Questions</h4>
                        <ul class="list-disc list-inside">
                            <li>How do I place an order?</li>
                            <li>What are the payment options?</li>
                            <li>How can I track my order?</li>
                            <li>What is your return policy?</li>
                        </ul>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-xl font-semibold mb-2">Need more help?</h4>
                        <p class="mb-4">Our customer service team is ready to assist you.</p>
                        <button id="open-chat-modal"
                            class="inline-block bg-[#fffaf5] text-black px-6 py-3 rounded-lg shadow hover:bg-[#ded7ce] transition font-semibold">
                            Chat with us
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @auth
        @php
            // Tentukan recipient_id (CS atau user lain)
            $recipientId =
                auth()->user()->is_cs ?? false
                    ? App\Models\User::where('is_cs', false)->first()->id ?? 1
                    : App\Models\User::where('is_cs', true)->first()->id ?? 1;
        @endphp
        <script>
            window.Laravel = {
                user: @json(auth()->user()),
                chatRecipientId: {{ auth()->user()->is_cs ? 'null' : $recipientId }},
                pusherKey: '{{ config('broadcasting.connections.pusher.key') }}',
                pusherCluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}'
            };
        </script>
        @include('components.chat')
    @endauth

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openChatModalButton = document.getElementById('open-chat-modal');
            const chatContainer = document.getElementById('chat-container');

            if (openChatModalButton && chatContainer) {
                openChatModalButton.addEventListener('click', function() {
                    chatContainer.classList.remove('hidden');
                    chatContainer.classList.add('flex');
                });
            }
        });
    </script>
</x-app-layout>
