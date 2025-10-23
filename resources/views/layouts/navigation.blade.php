<nav x-data="{ open: false }" class="bg-slate-50 border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Navigation Links -->
            <div class="flex">
                @auth('admin')
                    {{-- <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Admin Dashboard') }}
                        </x-nav-link>
                    </div> --}}
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.index')">
                            {{ __('Categories') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')">
                            {{ __('Products') }}
                        </x-nav-link>
                    </div>
                @else
                    {{-- <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </div> --}}
                    <div class="hidden sm:flex gap-4">
                        <div class="hidden sm:flex">
                            <x-nav-link :href="route('customer.products.index')" :active="request()->routeIs('customer.products.index')">
                                {{ __('Produk') }}
                            </x-nav-link>
                        </div>
                        <div class="hidden sm:flex">
                            <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                                {{ __('Cart') }}
                            </x-nav-link>
                        </div>
                        <div class="hidden sm:flex">
                            <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                                {{ __('Riwayat Pesanan') }}
                            </x-nav-link>
                        </div>
                    </div>
                @endauth
            </div>

            {{-- logo --}}
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @auth('admin')
                        <a href="{{ route('admin.dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if (Auth::guard('admin')->check() || Auth::check())
                    {{-- Jika sudah login (admin atau user biasa) --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                @auth('admin')
                                    <div>{{ Auth::guard('admin')->user()->name }}</div>
                                @else
                                    <div>{{ Auth::user()->name }}</div>
                                @endauth

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @auth('admin')
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('admin.logout')"
                                        onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                        {{ __('Log Out Admin') }}
                                    </x-dropdown-link>
                                </form>
                            @else
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            @endauth
                        </x-slot>
                    </x-dropdown>
                @else
                    {{-- Jika belum login --}}
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center px-4 py-2 bg-slate-100 border border-transparent rounded-md font-semibold text-xs text-black focus:text-slate-100 uppercase tracking-widest hover:bg-slate-300 focus:bg-blue-400 active:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Login') }}
                    </a>
                @endif
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
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('admin.logout')"
                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                {{ __('Log Out Admin') }}
                            </x-responsive-nav-link>
                        </form>
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
