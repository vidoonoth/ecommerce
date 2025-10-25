<nav x-data="{ open: false }" class="bg-[#f9f1eb] border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 py-2 sm:px-6 lg:px-8 flex justify-end">
        <!-- Navigation Links -->
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
                    <x-sub-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                        {{ __('Status Pesanan') }}
                    </x-sub-nav-link>
                </div>

                <span class="border border-slate-500"></span>

                <div class="hidden sm:flex">
                    <x-sub-nav-link :href="route('help.index')" :active="request()->routeIs('help.index')">
                        {{ __('Help') }}
                    </x-sub-nav-link>
                </div>

                <span class="border border-slate-500"></span>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex">
                    @if (Auth::guard('admin')->check() || Auth::check())
                        {{-- Jika sudah login (admin atau user biasa) --}}
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button
                                    class="group flex items-center justify-items-center justify-center gap-2 border border-transparent text-sm font-medium rounded-md text-gray-600 hover:text-gray-800 focus:outline-none transition ease-in-out duration-150">
                                    {{-- Ikon user --}}
                                    <svg class="w-5 h-5 text-gray-500 group-hover:text-black"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM2 14s1-1 8-1 8 1 8 1-1 4-8 4-8-4-8-4z" />
                                    </svg>

                                    {{-- Nama user --}}
                                    @auth('admin')
                                        <span class="group-hover:text-black">{{ Auth::guard('admin')->user()->name }}</span>
                                    @else
                                        <span class="group-hover:text-black">{{ Auth::user()->name }}</span>
                                    @endauth
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
            </div>
        @endauth
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
                    {{ __('Status Pesanan') }}
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
