<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @yield('content')
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body>
        <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <h2 class="text-center text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Shopping Cart</h2>

                <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                    <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                        {{-- --}}
                        <div class="space-y-6">
                            @foreach ($cart_items as $cart_item)
                                <div
                                    class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">

                                    <!-- Hidden input untuk bawa ID cart item -->
                                    <input type="hidden" name="cart_item_id" value="{{ $cart_item->id }}">

                                    <div
                                        class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                        <a href="{{ route('product.show', $cart_item->product->id) }}" class="shrink-0 md:order-1">
                                            <img class="h-20 w-20 dark:hidden"
                                                src="{{ $cart_item->product->image }}" alt="imac image" />
                                        </a>

                                        <label for="counter-input-{{ $cart_item->id }}" class="sr-only">Choose
                                            quantity:</label>

                                        <div class="flex items-center justify-between md:order-3 md:justify-end">
                                            <div class="flex items-center">
                                                <form action="{{ route('cart.update-quantity', $cart_item->id) }}" method="POST" class="flex items-center space-x-2">
                                                    @csrf
                                                    <input type="hidden" name="action" id="action-{{ $cart_item->id }}" value="">

                                                    <!-- Decrement Button -->
                                                    <button type="submit"
                                                        onclick="document.getElementById('action-{{ $cart_item->id }}').value='decrement';
                                                                 if ({{ $cart_item->quantity }} === 1) {
                                                                     return confirm('Are you sure you want to remove this item?') ? true : false;
                                                                 }"
                                                        class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600">
                                                        <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                        </svg>
                                                    </button>

                                                    <!-- Quantity Display -->
                                                    <input type="text" value="{{ $cart_item->quantity }}" readonly
                                                        class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" />

                                                    <!-- Increment Button -->
                                                    <button type="submit"
                                                        onclick="document.getElementById('action-{{ $cart_item->id }}').value='increment'"
                                                        class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600">
                                                        <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="text-end md:order-4 md:w-32">
                                                <p class="text-base font-bold text-gray-900 dark:text-white">
                                                    Rp {{ number_format($cart_item->product->price, 2) }}</p>
                                            </div>
                                        </div>

                                        <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                            <a href="{{ route('product.show', $cart_item->product->id) }}"
                                                class="text-base font-medium text-gray-900 hover:underline dark:text-white">{{ $cart_item->product->name }}</a>

                                            <div class="flex items-center gap-4">
                                                <form action="{{ route('cart.destroy', $cart_item->id) }}"
                                                    method="POST" class="delete-item-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Are you sure you want to remove this item?')"
                                                        class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                                        <svg class="me-1.5 h-5 w-5" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M6 18 17.94 6M18 18 6.06 6" />
                                                        </svg>
                                                        Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- order summary --}}
                        <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                            <div
                                class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                                <p class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>

                                <div class="space-y-4">
                                    <div class="space-y-2">

                                        <dl class="flex items-center justify-between gap-4">
                                            <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Subtotal
                                            </dt>
                                            <dd class="text-base font-medium text-gray-900 dark:text-white">
                                                Rp {{ number_format($cart->total_price, 2) }}</dd>
                                        </dl>

                                        <dl class="flex items-center justify-between gap-4">
                                            <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tax
                                                (10 %)</dt>
                                            <dd class="text-base font-medium text-gray-900 dark:text-white">
                                                Rp {{ number_format($cart->total_price * 0.1, 2) }}</dd>
                                        </dl>
                                    </div>

                                    <dl
                                        class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                        <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                                        <dd class="text-base font-bold text-gray-900 dark:text-white">
                                            Rp {{ number_format($cart->total_price * 1.1, 2) }}</dd>
                                    </dl>
                                </div>

                                @if($cart_items->count() > 0)
                                    <a href="{{ route('cart.checkout') }}" title=""
                                        class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                        Proceed to Checkout
                                    </a>
                                @else
                                    <button disabled
                                        class="flex w-full items-center justify-center rounded-lg bg-gray-400 px-5 py-2.5 text-sm font-medium text-white cursor-not-allowed">
                                        Cart is Empty
                                    </button>
                                @endif

                                <div class="flex items-center justify-center gap-2">
                                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
                                    <a href="{{route('product.index')}}" title=""
                                        class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                                        Continue Shopping
                                        <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M19 12H5m14 0-4 4m4-4-4-4" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

    </body>

    </html>

</x-app-layout>

