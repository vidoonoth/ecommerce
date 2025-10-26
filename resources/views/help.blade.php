<x-app-layout>
    <div class="w-fit mx-8 my-8">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Bantuan & Dukungan') }}
        </h2>
    </div>

    <div class="">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">Selamat datang di Pusat Bantuan Votise!</h3>
                    <p class="mb-4">Di sini kamu dapat menemukan jawaban atas pertanyaan umum serta panduan untuk berbelanja di Votise.</p>

                    <div class="mb-6">
                        <h4 class="text-xl font-semibold mb-2">Pertanyaan yang Sering Diajukan (FAQ)</h4>
                        <div x-data="{
                            activeAccordion: '',
                            setActiveAccordion(id) {
                                this.activeAccordion = (this.activeAccordion == id) ? '' : id
                            }
                        }"
                            class="relative w-full mx-auto overflow-hidden text-sm font-normal bg-white border border-gray-200 divide-y divide-gray-200 rounded-md">

                            {{-- 1 --}}
                            <div x-data="{ id: $id('accordion') }" class="cursor-pointer group">
                                <button @click="setActiveAccordion(id)"
                                    class="flex items-center justify-between w-full p-4 text-left select-none group-hover:underline">
                                    <span>Bagaimana cara melakukan pemesanan di Votise?</span>
                                    <svg class="w-4 h-4 duration-200 ease-out"
                                        :class="{ 'rotate-180': activeAccordion == id }" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </button>
                                <div x-show="activeAccordion==id" x-collapse x-cloak>
                                    <div class="p-4 pt-0 opacity-70">
                                        Untuk memesan sepatu di Votise, cukup pilih produk yang kamu inginkan, tentukan ukuran, lalu klik tombol <strong>“Tambah ke Keranjang”</strong>.
                                        Setelah itu buka keranjang belanja kamu dan klik <strong>“Checkout”</strong> untuk melanjutkan ke proses pembayaran.
                                    </div>
                                </div>
                            </div>

                            {{-- 2 --}}
                            <div x-data="{ id: $id('accordion') }" class="cursor-pointer group">
                                <button @click="setActiveAccordion(id)"
                                    class="flex items-center justify-between w-full p-4 text-left select-none group-hover:underline">
                                    <span>Metode pembayaran apa saja yang tersedia?</span>
                                    <svg class="w-4 h-4 duration-200 ease-out"
                                        :class="{ 'rotate-180': activeAccordion == id }" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </button>
                                <div x-show="activeAccordion==id" x-collapse x-cloak>
                                    <div class="p-4 pt-0 opacity-70">
                                        Votise menyediakan berbagai metode pembayaran aman melalui Midtrans, seperti:
                                        <ul class="list-disc pl-5 mt-2">
                                            <li>Transfer Bank (BCA, BNI, Mandiri, dll)</li>
                                            <li>E-Wallet (GoPay, OVO, ShopeePay, DANA)</li>
                                            <li>Kartu Kredit / Debit</li>
                                            <li>Virtual Account</li>
                                        </ul>
                                        Setelah pembayaran berhasil, pesananmu akan otomatis kami proses.
                                    </div>
                                </div>
                            </div>

                            {{-- 3 --}}
                            <div x-data="{ id: $id('accordion') }" class="cursor-pointer group">
                                <button @click="setActiveAccordion(id)"
                                    class="flex items-center justify-between w-full p-4 text-left select-none group-hover:underline">
                                    <span>Bagaimana cara melacak pesanan saya?</span>
                                    <svg class="w-4 h-4 duration-200 ease-out"
                                        :class="{ 'rotate-180': activeAccordion == id }" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </button>
                                <div x-show="activeAccordion==id" x-collapse x-cloak>
                                    <div class="p-4 pt-0 opacity-70">
                                        Setelah pesanan kamu dikirim, kamu akan menerima nomor resi pengiriman melalui email atau halaman <strong>“Riwayat Pesanan”</strong>.
                                        Kamu bisa melacak status pengiriman langsung dari halaman tersebut.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-xl font-semibold mb-2">Butuh bantuan lebih lanjut?</h4>
                        <p class="mb-4">Tim layanan pelanggan kami siap membantu kamu setiap hari kerja. Jangan ragu untuk menghubungi kami jika ada kendala atau pertanyaan terkait pesanan.</p>
                        <button id="open-chat-modal"
                            class="inline-block bg-[#fffaf5] text-black px-6 py-3 rounded-lg shadow hover:bg-[#ded7ce] transition font-semibold">
                            Chat dengan kami
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @auth
        @php
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
