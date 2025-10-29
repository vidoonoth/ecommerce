<nav x-data="{ open: false }" class="bg-[#fefbf9] border-b border-gray-200">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="flex justify-between h-12">

            {{-- logo --}}
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @auth('admin')
                        <a href="{{ route('admin.dashboard') }}">
                            {{-- <x-application-logo class="block h-9 w-auto fill-current text-gray-800" /> --}}
                            <p class="font-bold text-2xl">Votise</p>
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}">
                            {{-- <x-application-logo class="block h-9 w-auto fill-current text-gray-800" /> --}}
                            {{-- <p class="font-bold text-2xl">Votise</p> --}}
                            <img src="{{ asset('storage/logo/votise.png') }}" alt="Logo Votise" class="hidden lg:flex w-32 h-auto">
                            <img src="{{ asset('storage/logo/v.png') }}" alt="Logo Votise" class="flex lg:hidden w-[90px] h-auto">
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="flex">
                @auth('admin')
                    {{-- Admin navigation links are now in admin-sidenav.blade.php --}}
                @else
                    <div class="hidden sm:flex gap-4">
                        <div class="hidden sm:flex">
                            <x-nav-link :href="route('customer.products.index')" :active="request()->routeIs('customer.products.index')">
                                {{ __('Produk') }}
                            </x-nav-link>
                        </div>
                        {{-- brand --}}
                        <div class="hidden sm:flex">
                            <x-nav-link :href="route('customer.brands.index')" :active="request()->routeIs('customer.brands.index')">
                                {{ __('Brand') }}
                            </x-nav-link>
                        </div>
                        <div class="hidden sm:flex">
                            <x-nav-link :href="route('customer.categories.index')" :active="request()->routeIs('customer.categories.index')">
                                {{ __('Kategori') }}
                            </x-nav-link>
                        </div>
                    </div>
                @endauth
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="hidden sm:flex">
                    @auth('admin')
                    {{-- logout --}}
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <x-nav-link :href="route('admin.logout')"
                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                {!! '<i class="fi fi-rr-exit"></i>' !!}
                            </x-nav-link>
                        </form>
                    @else
                        <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                            {!! '<i class="fi fi-rr-shopping-cart"></i>' !!}
                        </x-nav-link>
                    @endauth
                </div>
            </div>


            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth('admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Admin Dashboard') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('customer.products.index')" :active="request()->routeIs('customer.products.index')">
                    {{ __('Produk') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                    {{ __('Cart') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                    {{ __('Riwayat Pesanan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('help.index')" :active="request()->routeIs('help.index')">
                    {{ __('Help') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @if (Auth::guard('admin')->check() || Auth::check())
                {{-- Jika SUDAH login (admin atau user biasa) --}}
                <div class="px-4">
                    @auth('admin')
                        <div class="font-medium text-base text-gray-800">{{ Auth::guard('admin')->user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::guard('admin')->user()->email }}</div>
                    @else
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    @endauth
                </div>

                <div class="mt-3 space-y-1">
                    @auth('admin')
                    @else
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    @endauth
                </div>
            @else
                {{-- Jika BELUM login --}}
                <div class="px-4">
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                </div>
            @endif
        </div>

    </div>
</nav>
