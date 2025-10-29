<aside class="w-52 bg-[#967e5e] text-white min-h-screen p-4">
    <div class="text-2xl font-bold mb-6">Admin Panel</div>
    <nav class="flex flex-col gap-3">
        <x-admin-side-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="block py-2.5 px-4 rounded transition duration-200">
            {{ __('Dashboard') }}
        </x-admin-side-nav-link>
        <x-admin-side-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.index')" class="block py-2.5 px-4 rounded transition duration-200">
            {{ __('Categories') }}
        </x-admin-side-nav-link>
        <x-admin-side-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')" class="block py-2.5 px-4 rounded transition duration-200">
            {{ __('Products') }}
        </x-admin-side-nav-link>
        <x-admin-side-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.index')" class="block py-2.5 px-4 rounded transition duration-200">
            {{ __('Orders') }}
        </x-admin-side-nav-link>
        {{-- <form method="POST" action="{{ route('admin.logout') }}" class="block">
            @csrf
            <x-admin-side-nav-link :href="route('admin.logout')"
                onclick="event.preventDefault();
                        this.closest('form').submit();"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                {{ __('Log Out Admin') }}
            </x-admin-side-nav-link>
        </form> --}}
    </nav>
</aside>
