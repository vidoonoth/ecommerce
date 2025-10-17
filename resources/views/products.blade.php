<x-app-layout>
    {{-- products --}}

    <div class="bg-white p-4 w-fit my-2 mx-2 rounded-lg">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produk') }}
        </h2>
    </div>


    {{-- cards products --}}

    <div class="max-w-7xl mx-auto sm:px-2 lg:px-2 py-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white  border-b border-gray-200">
                <div id="product-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <div class="border border-gray-200 hover:bg-slate-300 cursor-pointer rounded-lg p-4">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-40 object-cover mb-4 rounded" loading="lazy">
                            <h3 class="text-lg font-semibold mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($product->description, 100) }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xl font-bold text-gray-900">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                <button
                                    class="bg-blue-400 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Add to Cart
                                </button>
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
                                <p class="text-gray-600 mb-4">${product.description.substring(0, 100)}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-xl font-bold text-gray-900">Rp${new Intl.NumberFormat('id-ID').format(product.price)}</span>
                                    <button
                                        class="bg-blue-400 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        Add to Cart
                                    </button>
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




</x-app-layout>
