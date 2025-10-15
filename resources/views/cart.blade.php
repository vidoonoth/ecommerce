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
                        <!-- Example cart item -->
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/100"
                                        alt="Product Image">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Product Name</div>
                                        <div class="text-sm text-gray-500">Product Description</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                <div class="text-sm text-gray-900">$20.00</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                <input type="number" value="1" min="1"
                                    class="w-16 border border-gray-300 rounded-md px-2 py-1">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                <div class="text-sm text-gray-900">Rp20.000</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                <button class="text-red-600 hover:text-red-900">Remove</button>
                            </td>
                        </tr>
                        <!-- More cart items... -->
                    </tbody>
                </table>
            </div>

            <div class="">
                <div class="my-4 text-lg font-semibold">
                    Metode Pembayaran
                </div>
                <div class="mt-2">
                    <select class="border border-gray-300 rounded-md px-2 py-1 w-64">
                        <option value="credit_card">Kartu Kredit</option>
                        <option value="paypal">PayPal</option>
                        <option value="bank_transfer">Transfer Bank</option>
                    </select>
                </div>
            </div>

            <div class="mt-4 flex justify-end">
                <div class="text-lg font-semibold">
                    Total: Rp20.000
                </div>
            </div>
            <div class="mt-4 flex justify-end">
                <button class="bg-blue-400 text-white px-4 py-2 rounded-md hover:bg-blue-700">Bayar</button>
            </div>
        </div>
    </div>
</x-app-layout>
