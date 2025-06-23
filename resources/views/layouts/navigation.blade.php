<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center justify-center p-4">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('product.index')" :active="request()->routeIs('product.index')">
                        {{ __('Product') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Search Bar - Added in the center -->
            <div class="flex-1 max-w-md mx-4 hidden sm:flex my-3">
                <form  method="GET" action="{{ route('product.index') }}" class="w-full">
                    <div class="relative">
                        <input
                            type="text"
                            name="query"
                            placeholder="Search products..."
                            autocomplete="off"
                            value="{{ request('query') ? request('query') : '' }}"
                            class="w-full py-2 px-4 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        >

                        @if (request('categories'))
                            @foreach(request('categories') as $categoryId)
                                <input type="hidden" name="categories[]" value="{{ $categoryId }}">
                            @endforeach
                        @endif

                        <button
                            type="submit"
                            class="absolute right-0 top-0 h-full px-3 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="px-3">
                    <a href="{{ route('history.order') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1" stroke="currentColor"
                            class="block h-7 w-7 text-gray-800 dark:text-gray-200">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 2h12l4 4v5M4 2v20h10.5" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 2v6h6" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.5 10h6.5M6.5 14h5.5" />
                            <circle cx="19.5" cy="18.5" r="4" stroke="currentColor" stroke-width="1" fill="none" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 17v1.5l1 1" />
                        </svg>
                    </a>
                </div>

                <div class="px-3">
                    @auth
                        @if (Auth::user()->is_seller())
                            <a href="{{ route('seller.profile') }}">
                                <x-shop-icon class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"/>
                            </a>
                        @else
                            <a href="{{ route('seller.register') }}">
                                <x-shop-icon class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"/>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('seller.register') }}">
                            <x-shop-icon class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"/>
                        </a>
                    @endauth
                </div>
                <div class="relative px-3">
                    @auth
                        <span class="absolute top-0 right-0 inline-flex text-xs h-5 w-5 font-bold text-white rounded-full bg-red-600 flex items-center justify-center" style="height: 15px; width: 15px; font-size: 10px;">{{ $cart_count }}</span>
                    @endauth

                    <a href="{{ route('cart.index') }}">
                        <x-cart-icon class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"/>
                    </a>
                </div>

                @if (Route::has('login'))
                    @auth
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                            >
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-nav-link :href="route('product.index')" :active="request()->routeIs('product.index')">
                {{ __('Product') }}
            </x-nav-link>
        </div>

        <!-- Mobile Search Bar -->
        <div class="px-4 py-2">
            <form  method="GET">
                <div class="relative">
                    <input
                        type="text"
                        name="query"
                        placeholder="Search products..."
                        class="w-full py-2 px-4 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    >
                    <button
                        type="submit"
                        class="absolute right-0 top-0 h-full px-3 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
