<x-app-layout>
    <div class="bg-white p-4 w-fit my-2 mx-2 rounded-lg">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Keranjang Belanja') }}
        </h2>
    </div>

    <div class="px-2 py-2">
        <div class="bg-white rounded-lg overflow-hidden shadow-sm py-4 px-4">
            <div class="mb-4 text-lg font-semibold">
                Produk di Keranjang
            </div>
            <div class="overflow-x-auto">
                @if(session('cart') && count(session('cart')) > 0)
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Produk</th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Harga</th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kuantitas</th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total</th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0 @endphp
                            @foreach (session('cart') as $id => $item)
                                @php $total += $item['price'] * $item['quantity'] @endphp
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

                    <div class="mt-4 flex justify-end items-center">
                        <div class="text-lg font-semibold mr-4">Total: Rp{{ number_format($total, 0, ',', '.') }}</div>
                        <a href="{{ route('checkout.index') }}" class="bg-blue-400 text-white px-4 py-2 rounded-md hover:bg-green-700">
                            Lanjutkan ke Pembayaran
                        </a>
                    </div>
                @else
                    <p class="text-gray-600">Keranjang belanja Anda kosong.</p>
                    <a href="{{ route('customer.products.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Lanjutkan Belanja
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
