<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Order ID: {{ $order->order_id }}</h3>
                        <p>Customer: {{ $order->user->name ?? 'N/A' }}</p>
                        <p>Total Pembayaran: Rp{{ number_format($order->gross_amount, 0, ',', '.') }}</p>
                        <p>Status Transaksi: {{ $order->transaction_status }}</p>
                        <p>Tipe Pembayaran: {{ $order->payment_type }}</p>
                        <p>Tanggal: {{ $order->created_at->format('d M Y H:i') }}</p>
                    </div>

                    <div class="mb-4">
                        <h4 class="text-md font-semibold">Produk yang Dibeli:</h4>
                        @if ($order->products->count() > 0)
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nama Produk
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Harga
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kuantitas
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Subtotal
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($order->products as $product)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $product->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                Rp{{ number_format($product->pivot->price, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $product->pivot->quantity }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                Rp{{ number_format($product->pivot->price * $product->pivot->quantity, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Tidak ada produk yang terkait dengan pesanan ini.</p>
                        @endif
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('admin.orders.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali ke Daftar Pesanan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
