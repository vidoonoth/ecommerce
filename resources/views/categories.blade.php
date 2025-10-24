<x-app-layout>
    <div class="w-fit mx-8 my-2 border-b-2">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kategori') }}
        </h2>
    </div>

    <div class="max-w-7xl mx-auto sm:px-2 lg:px-2 py-2">
        <div class="bg-[#fffdfc] overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-[#fef8f5] border-b border-gray-200">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($categories as $category)
                        <a href="{{ route('customer.products.byCategory', $category->slug) }}" class="block">
                            <div class="border border-gray-200 hover:bg-[#e4dbd1] cursor-pointer rounded-lg p-4 text-center">
                                <h3 class="text-lg font-semibold mb-2">{{ $category->name }}</h3>
                                {{-- You can add an image or description for the category here if available --}}
                                {{-- <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-40 object-cover mb-4 rounded"> --}}
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
