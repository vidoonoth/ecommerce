<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <strong>ID:</strong> {{ $category->id }}
                    </div>
                    <div class="mb-4">
                        <strong>Name:</strong> {{ $category->name }}
                    </div>
                    <div class="mb-4">
                        <strong>Slug:</strong> {{ $category->slug }}
                    </div>
                    <div class="mb-4">
                        <strong>Created At:</strong> {{ $category->created_at }}
                    </div>
                    <div class="mb-4">
                        <strong>Updated At:</strong> {{ $category->updated_at }}
                    </div>
                    <a href="{{ route('admin.categories.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Back to Categories
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
