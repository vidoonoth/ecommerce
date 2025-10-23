<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-2 px-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-4 px-4">

            {{-- HERO BANNER --}}
            <div
                class="relative bg-gradient-to-r from-blue-100 via-white to-blue-50 rounded-xl mb-8 overflow-hidden shadow-sm">
                <div class="flex flex-col md:flex-row items-center justify-between px-8 py-10">
                    <div class="flex-1">
                        <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">Selamat Datang di <span
                                class="text-blue-500">Vorise</span></h1>
                        <p class="text-lg text-gray-600 mb-6">Temukan sepatu terbaik untuk gaya dan aktivitasmu. Promo
                            diskon hingga <span class="font-bold text-blue-600">50%</span> hari ini!</p>
                        <a href="#all-products"
                            class="inline-block bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600 transition font-semibold">Belanja
                            Sekarang</a>
                    </div>
                    <div class="flex-1 flex justify-center md:justify-end">
                        <div class="relative w-40 h-40 md:w-56 md:h-56">
                            @php $heroImages = $products->take(3); @endphp
                            @foreach ($heroImages as $i => $product)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="hero-slide absolute top-0 left-0 w-full h-full object-contain drop-shadow-xl rounded-xl transition-all duration-700 ease-in-out {{ $i === 0 ? 'opacity-100 translate-x-0 z-10' : 'opacity-0 translate-x-10 z-0' }}">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- KATEGORI --}}
            <div class="mt-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Kategori Populer</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div
                        class="flex flex-col items-center bg-white rounded-xl shadow hover:shadow-lg p-6 transition cursor-pointer group">
                        <div class="bg-blue-100 p-4 rounded-full mb-2 group-hover:bg-blue-200">
                            <img src="https://img.icons8.com/ios-filled/150/000000/sneakers.png" alt="Sepatu"
                                class="w-8 h-8 object-contain drop-shadow-xl">
                        </div>
                        <span class="font-semibold text-gray-700">Running</span>
                    </div>
                    <div
                        class="flex flex-col items-center bg-white rounded-xl shadow hover:shadow-lg p-6 transition cursor-pointer group">
                        <div class="bg-blue-100 p-4 rounded-full mb-2 group-hover:bg-blue-200">
                            <img src="https://img.icons8.com/ios-filled/50/000000/basketball.png" alt="Basket"
                                class="w-8 h-8">
                        </div>
                        <span class="font-semibold text-gray-700">Basket</span>
                    </div>
                    <div
                        class="flex flex-col items-center bg-white rounded-xl shadow hover:shadow-lg p-6 transition cursor-pointer group">
                        <div class="bg-blue-100 p-4 rounded-full mb-2 group-hover:bg-blue-200">
                            <img src="https://img.icons8.com/ios-filled/50/000000/football2.png" alt="Football"
                                class="w-8 h-8">
                        </div>
                        <span class="font-semibold text-gray-700">Football</span>
                    </div>
                    <div
                        class="flex flex-col items-center bg-white rounded-xl shadow hover:shadow-lg p-6 transition cursor-pointer group">
                        <div class="bg-blue-100 p-4 rounded-full mb-2 group-hover:bg-blue-200">
                            <img src="https://img.icons8.com/ios-filled/50/000000/casual-shoes.png" alt="Casual"
                                class="w-8 h-8">
                        </div>
                        <span class="font-semibold text-gray-700">Casual</span>
                    </div>
                </div>
            </div>

            {{-- all products --}}
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
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                        {{ Str::limit($product->description, 60) }}
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
                        class="absolute left-1 top-1/2 transform bg-black/70 text-white p-2 rounded-full shadow-md focus:outline-none">
                        &larr;
                    </button>
                    <button id="next-btn" aria-label="Next"
                        class="absolute right-1 top-1/2 transform bg-black/70 text-white p-2 rounded-full shadow-md focus:outline-none">
                        &rarr;
                    </button>
                </div>
            </div>

            {{-- KEUNGGULAN TOKO --}}
            <div class="mt-12 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Kenapa Pilih Sepatu Store?</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="flex flex-col items-center bg-white rounded-xl shadow p-6">
                        <img src="https://img.icons8.com/ios-filled/50/000000/delivery.png" class="w-10 h-10 mb-2"
                            alt="Fast Delivery">
                        <span class="font-semibold text-gray-700 mb-1">Pengiriman Cepat</span>
                        <span class="text-sm text-gray-500 text-center">Order sebelum jam 15.00 dikirim hari yang
                            sama.</span>
                    </div>
                    <div class="flex flex-col items-center bg-white rounded-xl shadow p-6">
                        <img src="https://img.icons8.com/ios-filled/50/000000/guarantee.png" class="w-10 h-10 mb-2"
                            alt="Garansi">
                        <span class="font-semibold text-gray-700 mb-1">Garansi Produk</span>
                        <span class="text-sm text-gray-500 text-center">Garansi tukar jika produk cacat atau tidak
                            sesuai.</span>
                    </div>
                    <div class="flex flex-col items-center bg-white rounded-xl shadow p-6">
                        <img src="https://img.icons8.com/ios-filled/50/000000/price-tag-euro.png" class="w-10 h-10 mb-2"
                            alt="Harga Terbaik">
                        <span class="font-semibold text-gray-700 mb-1">Harga Terbaik</span>
                        <span class="text-sm text-gray-500 text-center">Diskon dan promo menarik setiap minggu.</span>
                    </div>
                    <div class="flex flex-col items-center bg-white rounded-xl shadow p-6">
                        <img src="https://img.icons8.com/ios-filled/50/000000/customer-support.png"
                            class="w-10 h-10 mb-2" alt="Support">
                        <span class="font-semibold text-gray-700 mb-1">Support 24/7</span>
                        <span class="text-sm text-gray-500 text-center">Tim CS siap membantu kapan saja.</span>
                    </div>
                </div>
            </div>

            {{-- TESTIMONI --}}
            <div class="mt-12 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Testimoni Pelanggan</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="w-16 h-16 rounded-full mb-2"
                            alt="User">
                        <p class="text-gray-700 text-center mb-2 italic">"Sepatunya nyaman banget, pengiriman cepat!"
                        </p>
                        <div class="flex gap-1 mb-1">
                            <span class="text-yellow-400">★</span><span class="text-yellow-400">★</span><span
                                class="text-yellow-400">★</span><span class="text-yellow-400">★</span><span
                                class="text-yellow-400">★</span>
                        </div>
                        <span class="text-sm text-gray-500">- Andi, Jakarta</span>
                    </div>
                    <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg"
                            class="w-16 h-16 rounded-full mb-2" alt="User">
                        <p class="text-gray-700 text-center mb-2 italic">"Modelnya keren, cocok buat hangout!"</p>
                        <div class="flex gap-1 mb-1">
                            <span class="text-yellow-400">★</span><span class="text-yellow-400">★</span><span
                                class="text-yellow-400">★</span><span class="text-yellow-400">★</span><span
                                class="text-yellow-400">★</span>
                        </div>
                        <span class="text-sm text-gray-500">- Sari, Bandung</span>
                    </div>
                    <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
                        <img src="https://randomuser.me/api/portraits/men/65.jpg" class="w-16 h-16 rounded-full mb-2"
                            alt="User">
                        <p class="text-gray-700 text-center mb-2 italic">"Harga terjangkau, kualitas mantap!"</p>
                        <div class="flex gap-1 mb-1">
                            <span class="text-yellow-400">★</span><span class="text-yellow-400">★</span><span
                                class="text-yellow-400">★</span><span class="text-yellow-400">★</span><span
                                class="text-yellow-400">★</span>
                        </div>
                        <span class="text-sm text-gray-500">- Budi, Surabaya</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- footer --}}
    <footer class="bg-slate-50 text-black py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Vorise. All rights reserved.</p>
        </div>
    </footer>

    {{-- MODAL DETAIL PRODUK --}}
    <div id="product-modal" class="fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="bg-white rounded-xl shadow-lg max-w-sm w-full p-6 relative">
            <button id="close-modal"
                class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-2xl font-bold">&times;</button>
            <img id="modal-image" src="" alt="" class="w-full h-40 object-contain rounded mb-4">
            <h3 id="modal-name" class="text-xl font-bold mb-2"></h3>
            <p id="modal-desc" class="text-gray-600 mb-4"></p>
            <div class="flex items-center justify-between">
                <span id="modal-price" class="text-lg font-bold text-gray-900"></span>
            </div>
        </div>
    </div>

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
        });

        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.hero-slide');
            let current = 0;
            setInterval(() => {
                slides.forEach((img, i) => {
                    if (i === current) {
                        img.classList.remove('opacity-0', 'translate-x-10', 'z-0');
                        img.classList.add('opacity-100', 'translate-x-0', 'z-10');
                    } else {
                        img.classList.remove('opacity-100', 'translate-x-0', 'z-10');
                        img.classList.add('opacity-0', 'translate-x-10', 'z-0');
                    }
                });
                current = (current + 1) % slides.length;
            }, 2500);
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Modal logic
            const modal = document.getElementById('product-modal');
            const closeModal = document.getElementById('close-modal');
            const modalImage = document.getElementById('modal-image');
            const modalName = document.getElementById('modal-name');
            const modalDesc = document.getElementById('modal-desc');
            const modalPrice = document.getElementById('modal-price');
            // Card click event
            document.querySelectorAll('#product-carousel .snap-start').forEach(card => {
                card.addEventListener('click', function(e) {
                    // Prevent modal if Add button or form is clicked
                    if (e.target.closest('form') || e.target.closest('button')) return;
                    const img = card.querySelector('img');
                    const name = card.querySelector('h3').textContent;
                    const desc = card.querySelector('p').textContent;
                    const price = card.querySelector('span').textContent;
                    modalImage.src = img.src;
                    modalImage.alt = name;
                    modalName.textContent = name;
                    modalDesc.textContent = desc;
                    modalPrice.textContent = price;
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });
            });
            // Close modal
            closeModal.addEventListener('click', function() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });
            // Click outside modal
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            });
        });
    </script>
</x-app-layout>
