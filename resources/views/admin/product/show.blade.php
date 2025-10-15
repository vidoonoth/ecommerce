<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <strong>ID:</strong> {{ $product->id }}
                    </div>
                    <div class="mb-4">
                        <strong>Category:</strong> {{ $product->category->name }}
                    </div>
                    <div class="mb-4">
                        <strong>Name:</strong> {{ $product->name }}
                    </div>
                    <div class="mb-4">
                        <strong>Slug:</strong> {{ $product->slug }}
                    </div>
                    <div class="mb-4">
                        <strong>Description:</strong> {{ $product->description }}
                    </div>
                    <div class="mb-4">
                        <strong>Price:</strong> Rp{{ number_format($product->price, 2, ',', '.') }}
                    </div>
                    <div class="mb-4">
                        <strong>Stock:</strong> {{ $product->stock }}
                    </div>
                    <div class="mb-4">
                        <strong>Image:</strong>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-40 w-40 object-cover">
                        @else
                            N/A
                        @endif
                    </div>
                    <div class="mb-4">
                        <strong>Created At:</strong> {{ $product->created_at }}
                    </div>
                    <div class="mb-4">
                        <strong>Updated At:</strong> {{ $product->updated_at }}
                    </div>
                    <a href="{{ route('admin.products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Back to Products
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
