<x-app-layout>
    <div class="bg-white p-4 w-fit my-2 mx-2 rounded-lg">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Keranjang') }}
        </h2>
    </div>

    <div class="px-2 py-2">
        <div class="bg-white rounded-lg overflow-hidden shadow-sm py-4 px-4">
            <div class="mb-4 text-lg font-semibold">
                Produk
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Produk</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Quantity</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $id => $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                    <div class="flex items-center">
                                        <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $item['image']) }}"
                                            alt="{{ $item['name'] }}">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $item['name'] }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                    <div class="text-sm text-gray-900">Rp{{ number_format($item['price'], 0, ',', '.') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                    <form action="{{ route('cart.update', $id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="0"
                                            class="w-16 border border-gray-300 rounded-md px-2 py-1" onchange="this.form.submit()">
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                    <div class="text-sm text-gray-900">Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4 flex justify-end items-center">
                <div class="text-lg font-semibold mr-4">Total: Rp{{ number_format($total, 0, ',', '.') }}</div>
                <button id="pay-button" class="bg-[#fcf7f1] border-[#feead6] text-black px-4 py-2 rounded-md hover:bg-[#e4dbd1]">Bayar</button>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}" defer></script>
        <script type="text/javascript">
            console.log('Checkout script loaded.'); // Added for debugging
            console.log('Midtrans Client Key:', "{{ config('midtrans.client_key') }}");
            console.log('Snap Token:', "{{ $snapToken }}");

            document.addEventListener('DOMContentLoaded', function() {
                console.log('DOM Content Loaded. Attaching event listener.'); // Added for debugging
                const payButton = document.getElementById('pay-button');
                if (payButton) {
                    payButton.onclick = function() {
                        console.log('Pay button clicked!');
                        if (typeof snap !== 'undefined' && "{{ $snapToken }}") {
                            console.log('Attempting to call snap.pay() with token:', "{{ $snapToken }}");
                            snap.pay('{{ $snapToken }}', {
                            onSuccess: function(result) {
                                alert('Pembayaran berhasil!');
                                window.location.href = '{{ route('orders.index') }}'; // Redirect to order history
                            },
                                onPending: function(result) {
                                    alert('Pembayaran tertunda!');
                                },
                                onError: function(result) {
                                    alert('Pembayaran gagal!');
                                },
                                onClose: function() {
                                    alert('Anda menutup pop-up tanpa menyelesaikan pembayaran');
                                }
                            });
                        } else {
                            if (typeof snap === 'undefined') {
                                alert('Midtrans Snap.js belum dimuat. Coba muat ulang halaman.');
                                console.error('Midtrans Snap.js is not loaded.');
                            } else {
                                alert('Snap Token tidak tersedia. Tidak dapat memproses pembayaran.');
                                console.error('Snap Token is empty or null.');
                            }
                        }
                    };
                } else {
                    console.error('Pay button element not found!');
                }
            });
        </script>
    @endpush
</x-app-layout>
