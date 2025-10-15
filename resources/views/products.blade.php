<x-app-layout>
    {{-- products --}}

    <div class="bg-white p-4 w-fit my-2 mx-2 rounded-lg">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produk') }}
        </h2>
    </div>


    {{-- cards products (data dummy) --}}

    <div class="max-w-7xl mx-auto sm:px-2 lg:px-2 py-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white  border-b border-gray-200">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @for ($i = 1; $i <= 8; $i++)
                        <div class="border border-gray-200 hover:bg-slate-300 cursor-pointer rounded-lg p-4">
                            <img src="https://via.placeholder.com/150" alt="Product Image"
                                class="w-full h-40 object-cover mb-4 rounded">
                            <h3 class="text-lg font-semibold mb-2">Product {{ $i }}</h3>
                            <p class="text-gray-600 mb-4">This is a brief description of Product {{ $i }}.
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-xl font-bold text-gray-900">$19.99</span>
                                <button
                                    class="bg-blue-400 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>




</x-app-layout>
