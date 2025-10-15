<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-2 px-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-4 px-4">

            {{-- iklan --}}
            <div id="iklan" class="p-6 bg-blue-300 text-gray-900 rounded-xl">
                <div id="text" class="">
                    <p class="text-xl">Fashion Store</p>
                    <p>Shopping with our family, friends, couples</p>
                </div>
            </div>

            <div id="category" class="flex flex-col mt-8">
                <div class="flex justify-between mb-4">
                    <p id="text" class="font-bold">Kategori</p>
                    <p>Lihat semua</p>
                </div>

                <div class="cards-category">
                    <div class="card-category bg-slate-300 w-fit p-6">
                        <p>Baju</p>
                    </div>
                </div>
            </div>

            <div id="all-products" class="flex flex-col mt-8">
                <div class="flex justify-between mb-4">
                    <p class="font-bold">Semua Produk</p>
                </div>

                <div class="cards-products">
                    <div class="card-product bg-slate-300 w-fit p-6">
                        <p>Produk 1</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- footer --}}
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Your Company. All rights reserved.</p>
        </div>
    </footer>
</x-app-layout>
