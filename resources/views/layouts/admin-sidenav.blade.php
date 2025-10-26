<aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
    <div class="text-2xl font-bold mb-6">Admin Panel</div>
    <nav>
        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
            {{ __('Dashboard') }}
        </x-nav-link>
        <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.index')" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
            {{ __('Categories') }}
        </x-nav-link>
        <x-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
            {{ __('Products') }}
        </x-nav-link>
        <x-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.index')" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
            {{ __('Orders') }}
        </x-nav-link>
        <form method="POST" action="{{ route('admin.logout') }}" class="block">
            @csrf
            <x-nav-link :href="route('admin.logout')"
                onclick="event.preventDefault();
                        this.closest('form').submit();"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                {{ __('Log Out Admin') }}
            </x-nav-link>
        </form>
    </nav>
</aside>
