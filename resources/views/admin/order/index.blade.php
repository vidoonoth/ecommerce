<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 text-lg font-semibold">
                        Daftar Semua Pesanan
                    </div>
                    <div class="overflow-x-auto">
                        @if ($orders->count() > 0)
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Order ID</th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Customer</th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total Pembayaran</th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jumlah Produk</th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status Transaksi</th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tipe Pembayaran</th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal</th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                                {{ $order->order_id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                                {{ $order->user->name ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                                Rp{{ number_format($order->gross_amount, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                                {{ $order->products->sum('pivot.quantity') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                                {{ $order->transaction_status }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                                {{ $order->payment_type }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                                {{ $order->created_at->format('d M Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 text-sm font-medium">
                                                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                                {{-- Add more actions like edit/delete if needed --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-gray-600">Tidak ada pesanan yang tersedia.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
