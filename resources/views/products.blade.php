<x-app-layout>
    {{-- products --}}

    <div class="w-fit mx-8 my-8">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Produk') }}
        </h2>
    </div>


    {{-- cards products --}}

    <div class="max-w-7xl mx-auto sm:px-2 lg:px-2 py-2">
        <div class="bg-[#fffdfc] overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-[#fef8f5]  border-b border-gray-200">
                <div id="product-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <div class="border border-gray-200 hover:bg-[#e4dbd1] cursor-pointer rounded-lg p-4">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-40 object-cover mb-4 rounded" loading="lazy">
                            <h3 class="text-lg font-semibold mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-600 text-sm mb-1">Kategori: {{ $product->category->name }}</p>
                            <p class="text-gray-600 text-sm mb-4">Brand: {{ $product->brand->name }}</p>
                            <p class="text-gray-600 mb-4">{{ Str::limit($product->description, 100) }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xl font-bold text-gray-900">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-[#fcf7f1] border-[#ffd9b4] border text-slate-900 font-medium px-4 py-2 rounded hover:bg-[#fae7d1] focus:outline-none focus:ring-2 focus:ring-[#fdd7ab]">
                                        Beli
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div id="loading-indicator" class="text-center py-4 hidden">
                    <div class="animate-pulse flex space-x-4">
                        <div class="rounded-full bg-slate-200 h-10 w-10"></div>
                        <div class="flex-1 space-y-6 py-1">
                            <div class="h-2 bg-slate-200 rounded"></div>
                            <div class="space-y-3">
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="h-2 bg-slate-200 rounded col-span-2"></div>
                                    <div class="h-2 bg-slate-200 rounded col-span-1"></div>
                                </div>
                                <div class="h-2 bg-slate-200 rounded"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentPage = {{ $products->currentPage() }};
        const lastPage = {{ $products->lastPage() }};
        const productContainer = document.getElementById('product-container');
        const loadingIndicator = document.getElementById('loading-indicator');
        let loading = false;

        function loadMoreProducts() {
            if (currentPage >= lastPage || loading) {
                return;
            }

            loading = true;
            loadingIndicator.classList.remove('hidden');
            currentPage++;

            fetch(`/api/products?page=${currentPage}`)
                .then(response => response.json())
                .then(data => {
                    data.data.forEach(product => {
                        const productCard = `
                            <div class="border border-gray-200 hover:bg-slate-300 cursor-pointer rounded-lg p-4">
                                <img src="/storage/${product.image}" alt="${product.name}"
                                    class="w-full h-40 object-cover mb-4 rounded" loading="lazy">
                                <h3 class="text-lg font-semibold mb-2">${product.name}</h3>
                                <p class="text-gray-600 text-sm mb-1">Kategori: ${product.category.name}</p>
                                <p class="text-gray-600 text-sm mb-4">Brand: ${product.brand.name}</p>
                                <p class="text-gray-600 mb-4">${product.description.substring(0, 100)}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-xl font-bold text-gray-900">Rp${new Intl.NumberFormat('id-ID').format(product.price)}</span>
                                    <form action="/cart/add/${product.id}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-blue-400 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            Add to Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        `;
                        productContainer.insertAdjacentHTML('beforeend', productCard);
                    });
                    loadingIndicator.classList.add('hidden');
                    loading = false;
                })
                .catch(error => {
                    console.error('Error fetching more products:', error);
                    loadingIndicator.classList.add('hidden');
                    loading = false;
                });
        }

        window.addEventListener('scroll', () => {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100) {
                loadMoreProducts();
            }
        });
    </script>
            </div>
        </div>
    </div>

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
            // Modal logic
            const modal = document.getElementById('product-modal');
            const closeModal = document.getElementById('close-modal');
            const modalImage = document.getElementById('modal-image');
            const modalName = document.getElementById('modal-name');
            const modalDesc = document.getElementById('modal-desc');
            const modalPrice = document.getElementById('modal-price');
            // Card click event
            document.querySelectorAll('#product-container > div').forEach(card => {
                card.addEventListener('click', function(e) {
                    // Prevent modal if Add button or form is clicked
                    if (e.target.closest('form') || e.target.closest('button')) return;
                    const img = card.querySelector('img');
                    const name = card.querySelector('h3').textContent;
                    const desc = card.querySelector('p:nth-of-type(3)').textContent; // Adjusted selector for description
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
