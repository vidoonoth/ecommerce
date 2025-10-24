<x-app-layout>
    <div class="bg-white p-4 w-fit my-2 mx-2 rounded-lg">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pesanan') }}
        </h2>
    </div>

    <div class="px-2 py-2">
        <div class="bg-white rounded-lg overflow-hidden shadow-sm py-4 px-4">
            <div class="mb-4 text-lg font-semibold">
                Daftar Pesanan Anda
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
                                    Total Pembayaran</th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status Transaksi</th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tipe Pembayaran</th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                        {{ $order->order_id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                        Rp{{ number_format($order->gross_amount, 0, ',', '.') }}
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-600">Anda belum memiliki riwayat pesanan.</p>
                    <a href="{{ route('customer.products.index') }}" class="mt-4 inline-block bg-[#fcf7f1] border-[#ffd9b4] text-black px-4 py-2 rounded-md hover:bg-[#fae7d1]">
                        Mulai Belanja
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
