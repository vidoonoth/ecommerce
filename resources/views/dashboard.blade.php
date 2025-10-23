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
                <div class="relative">
                    <div id="product-carousel"
                        class="flex overflow-x-auto space-x-4 pb-4 scroll-smooth snap-x snap-mandatory px-4 mx-14">
                        @foreach ($products as $product)
                            <div
                                class="w-64 snap-start bg-white border border-gray-200 hover:shadow-lg hover:scale-105 transform transition p-4 rounded-lg h-80 flex flex-col justify-between">
                                <div>
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-36 object-cover mb-4 rounded-lg" loading="lazy">
                                    <h3 class="text-lg font-semibold mb-1 truncate">{{ $product->name }}</h3>
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ Str::limit($product->description, 60) }}
                                    </p>
                                </div>
                                <div class="flex items-center justify-between mt-2">
                                    <span
                                        class="text-lg font-bold text-gray-900">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                    <form action="{{ route('cart.add', $product) }}" method="POST"
                                        class="add-to-cart-form">
                                        @csrf
                                        <button type="submit"
                                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                                            Add
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button id="prev-btn" aria-label="Previous"
                        class="absolute left-1 top-1/2 transform bg-black/70 text-white p-2 rounded-full shadow-md focus:outline-none hidden sm:block">
                        &larr;
                    </button>
                    <button id="next-btn" aria-label="Next"
                        class="absolute right-1 top-1/2 transform bg-black/70 text-white p-2 rounded-full shadow-md focus:outline-none hidden sm:block">
                        &rarr;
                    </button>
                </div>
            </div>

        </div>
    </div>

    {{-- footer --}}
    <footer class="bg-slate-50 text-black py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Your Company. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('product-carousel');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            if (!carousel || !prevBtn || !nextBtn) return;
            carousel.style.scrollbarWidth = 'none';
            carousel.style.msOverflowStyle = 'none';

            function getGap() {
                try {
                    const style = getComputedStyle(carousel);
                    const gap = style.columnGap || style.gap || '16px';
                    return parseInt(gap, 10) || 16;
                } catch (e) {
                    return 16;
                }
            }

            function scrollStep(direction = 1) {
                const card = carousel.querySelector('.snap-start');
                if (!card) return;
                const step = card.offsetWidth + getGap();
                carousel.scrollBy({
                    left: step * direction,
                    behavior: 'smooth'
                });
            }
            nextBtn.addEventListener('click', function() {
                scrollStep(1);
            });
            prevBtn.addEventListener('click', function() {
                scrollStep(-1);
            });

            function updateControls() {
                const show = window.innerWidth >= 640;
                prevBtn.classList.toggle('hidden', !show);
                nextBtn.classList.toggle('hidden', !show);
            }
            updateControls();
            window.addEventListener('resize', updateControls);
        });
    </script>
</x-app-layout>
