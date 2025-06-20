<x-app-layout>
  <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-8">
  @yield('content')
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
    <div class="mx-auto max-w-screen-lg px-4 2xl:px-0">
      <nav class="mb-4 flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
          <li class="inline-flex items-center">
            <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">
              <svg class="me-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
              </svg>
              Home
            </a>
          </li>
          <li>
            <div class="flex items-center">
              <svg class="mx-1 h-4 w-4 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
              </svg>
              <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white md:ms-2">My Account</a>
            </div>
          </li>
          <li aria-current="page">
            <div class="flex items-center">
              <svg class="mx-1 h-4 w-4 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
              </svg>
              <span class="ms-1 text-sm font-medium text-gray-500 dark:text-gray-400 md:ms-2">Store Account</span>
            </div>
          </li>
        </ol>
      </nav>
      <h2 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl md:mb-6">Profil Toko</h2>
      <div class="py-4 md:py-8">
        <div class="mb-4 grid gap-4 sm:grid-cols-2 sm:gap-8 lg:gap-16">
          <div class="space-y-4">
            <div class="flex space-x-4">
              <img class="h-16 w-16 rounded-lg" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/helene-engels.png" alt="Helene avatar" />
              <div>
                <h2 class="flex items-center text-xl font-bold leading-none text-gray-900 dark:text-white sm:text-2xl">{{ $seller->store_name }}</h2>
              </div>
            </div>

            <dl>
              <dt class="font-semibold text-gray-900 dark:text-white">Nama Pemilik Toko</dt>
              <dd class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
                <svg class="hidden h-5 w-5 shrink-0 text-gray-400 dark:text-gray-500 lg:inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                </svg>
                {{ $seller->contact_person }}
              </dd>
            </dl>
            
            <dl>
              <dt class="font-semibold text-gray-900 dark:text-white">Alamat Toko</dt>
              <dd class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
                <svg class="hidden h-5 w-5 shrink-0 text-gray-400 dark:text-gray-500 lg:inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                </svg>
                {{ $seller->seller_address }}
              </dd>
            </dl>

            <dl class="">
              <dt class="font-semibold text-gray-900 dark:text-white">Email Address</dt>
              <dd class="text-gray-500 dark:text-gray-400">{{ $seller->email }}</dd>
            </dl>
          
          </div>

          <div class="space-y-4">
            <dl>
              <dt class="font-semibold text-gray-900 dark:text-white">Phone Number</dt>
              <dd class="text-gray-500 dark:text-gray-400">{{ $seller->contact_number }}</dd>
            </dl>
            

          </div>
        </div>
        <button type="button" data-modal-target="accountInformationModal2" data-modal-toggle="accountInformationModal2" class="inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 sm:w-auto">
          <svg class="-ms-0.5 me-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"></path>
          </svg>
          Edit your data
        </button>
          <a type="button " href="{{ route('seller.product') }}"
                  class="inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 sm:w-auto">
                  <svg class="-ms-0.5 me-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                      fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z">
                      </path>
                  </svg>
                  Edit product
          </a>
      </div>

      <h2 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl md:mb-6">Produk Toko</h2>

      <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
        @foreach ($products as $product)
          <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
              <div class="h-56 w-full">
                  <a href="{{ route('product.show', $product->id) }}">
                      <img class="mx-auto h-full dark:hidden"
                          src="/image/{{ $product->image }}" alt="" />
                      {{-- <img class="mx-auto hidden h-full dark:block"
                          src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg" alt="" /> --}}
                  </a>
              </div>
              <div class="pt-6">
  
                  <a href="{{ route('product.show', $product->id) }}"
                      class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white line-clamp-2 overflow-hidden text-ellipsis">
                      {{ $product->name }}
                  </a>
  
                                  <div class="mt-2 flex items-center gap-2">
                    <div class="flex items-center">
                        @php
                            $averageRating = $product->ratings->avg('rating');
                            $fullStars = floor($averageRating);
                            $hasHalfStar = $averageRating - $fullStars >= 0.5;
                        @endphp
                        
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $fullStars)
                                <!-- Full star -->
                                <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"/>
                                </svg>
                            @elseif($i == $fullStars + 1 && $hasHalfStar)
                                <!-- Half star -->
                                <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <defs>
                                        <linearGradient id="half-star-{{ $product->id }}" x1="0" x2="100%" y1="0" y2="0">
                                            <stop offset="50%" stop-color="#fbbf24" />
                                            <stop offset="50%" stop-color="#d1d5db" />
                                        </linearGradient>
                                    </defs>
                                    <path fill="url(#half-star-{{ $product->id }})" 
                                        d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"/>
                                </svg>
                            @else
                                <!-- Empty star -->
                                <svg class="h-4 w-4 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"/>
                                </svg>
                            @endif
                        @endfor
                    </div>

                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ number_format($averageRating, 1) }}</p>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">({{ $product->ratings->count() }})</p>
                </div>
  
                  <div class="mt-4 flex items-center justify-between gap-4">
                      <p class="text-lg font-extrabold leading-tight text-gray-900 dark:text-white">Rp {{ number_format($product->price) }}</p>
                  </div>
              </div>
          </div>
        @endforeach
      </div>

      <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800 md:p-8">
        <h3 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white">Order History</h3>
        <div class="flex flex-wrap items-center gap-y-4 border-b border-gray-200 pb-4 dark:border-gray-700 md:pb-5">
          <dl class="w-1/2 sm:w-48">
            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Order ID:</dt>
            <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
              <a href="#" class="hover:underline">#FWB12546798</a>
            </dd>
          </dl>
  
          <dl class="w-1/2 sm:w-1/4 md:flex-1 lg:w-auto">
            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Date:</dt>
            <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">11.12.2023</dd>
          </dl>
  
          <dl class="w-1/2 sm:w-1/5 md:flex-1 lg:w-auto">
            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Price:</dt>
            <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">$499</dd>
          </dl>
  
          <dl class="w-1/2 sm:w-1/4 sm:flex-1 lg:w-auto">
            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Status:</dt>
            <dd class="me-2 mt-1.5 inline-flex shrink-0 items-center rounded bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
              <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"></path>
              </svg>
              In transit
            </dd>
          </dl>
          <button
            type="button"
            id="processButton"
            onclick="handleProcessing(this)"
            data-modal-target="accountInformationModal2"
            data-modal-toggle="accountInformationModal2"
            class="inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 sm:w-auto"
          >
            <svg class="-ms-0.5 me-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"></path>
            </svg>
            <span>Process</span>
          </button>

          <script>
            function handleProcessing(button) {
              // Ganti isi tombol jadi "Processed"
              button.innerHTML = `
                <svg class="-ms-0.5 me-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>Processed</span>
              `;
              
              // Opsional: menonaktifkan tombol setelah diklik
              button.disabled = true;
              button.classList.add('bg-green-600', 'hover:bg-green-700');
            }
          </script>
  
          {{-- <div class="w-full sm:flex sm:w-32 sm:items-center sm:justify-end sm:gap-4">
            <button
              id="actionsMenuDropdownModal10"
              data-dropdown-toggle="dropdownOrderModal10"
              type="button"
              class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 md:w-auto"
            >
              Actions
              <svg class="-me-0.5 ms-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"></path>
              </svg>
            </button>
            <div id="dropdownOrderModal10" class="z-10 hidden w-40 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom">
              <ul class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400" aria-labelledby="actionsMenuDropdown10">
                <li>
                  <a href="#" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4"></path>
                    </svg>
                    <span>Order again</span>
                  </a>
                </li>
                <li>
                  <a href="#" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"></path>
                      <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                    </svg>
                    Order details
                  </a>
                </li>
                <li>
                  <a href="#" data-modal-target="deleteOrderModal" data-modal-toggle="deleteOrderModal" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="me-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"></path>
                    </svg>
                    Cancel order
                  </a>
                </li>
              </ul>
            </div>
          </div> --}}
        </div>
        <div class="flex flex-wrap items-center gap-y-4 border-b border-gray-200 py-4 pb-4 dark:border-gray-700 md:py-5">
          <dl class="w-1/2 sm:w-48">
            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Order ID:</dt>
            <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
              <a href="#" class="hover:underline">#FWB12546777</a>
            </dd>
          </dl>
  
          <dl class="w-1/2 sm:w-1/4 md:flex-1 lg:w-auto">
            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Date:</dt>
            <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">10.11.2024</dd>
          </dl>
  
          <dl class="w-1/2 sm:w-1/5 md:flex-1 lg:w-auto">
            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Price:</dt>
            <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">$3,287</dd>
          </dl>
  
          <dl class="w-1/2 sm:w-1/4 sm:flex-1 lg:w-auto">
            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Status:</dt>
            <dd class="mt-1.5 inline-flex items-center rounded bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
              <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"></path>
              </svg>
              Cancelled
            </dd>
          </dl>
          <button
            type="button"
            id="processButton"
            onclick="handleProcessing(this)"
            data-modal-target="accountInformationModal2"
            data-modal-toggle="accountInformationModal2"
            class="inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 sm:w-auto"
          >
            <svg class="-ms-0.5 me-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"></path>
            </svg>
            <span>Process</span>
          </button>

          <script>
            function handleProcessing(button) {
              // Ganti isi tombol jadi "Processed"
              button.innerHTML = `
                <svg class="-ms-0.5 me-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>Processed</span>
              `;
              
              // Opsional: menonaktifkan tombol setelah diklik
              button.disabled = true;
              button.classList.add('bg-green-600', 'hover:bg-green-700');
            }
          </script>
  
          {{-- <div class="w-full sm:flex sm:w-32 sm:items-center sm:justify-end sm:gap-4">
            <button
              id="actionsMenuDropdownModal11"
              data-dropdown-toggle="dropdownOrderModal11"
              type="button"
              class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 md:w-auto"
            >
              Actions
              <svg class="-me-0.5 ms-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"></path>
              </svg>
            </button>
            <div id="dropdownOrderModal11" class="z-10 hidden w-40 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom">
              <ul class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400" aria-labelledby="actionsMenuDropdown11">
                <li>
                  <a href="#" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4"></path>
                    </svg>
                    <span>Order again</span>
                  </a>
                </li>
                <li>
                  <a href="#" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"></path>
                      <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                    </svg>
                    Order details
                  </a>
                </li>
              </ul>
            </div>
          </div> --}}
        </div>
        <div class="flex flex-wrap items-center gap-y-4 border-b border-gray-200 py-4 pb-4 dark:border-gray-700 md:py-5">
          <dl class="w-1/2 sm:w-48">
            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Order ID:</dt>
            <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
              <a href="#" class="hover:underline">#FWB12546846</a>
            </dd>
          </dl>
  
          <dl class="w-1/2 sm:w-1/4 md:flex-1 lg:w-auto">
            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Date:</dt>
            <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">07.11.2024</dd>
          </dl>
  
          <dl class="w-1/2 sm:w-1/5 md:flex-1 lg:w-auto">
            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Price:</dt>
            <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">$111</dd>
          </dl>
  
          <dl class="w-1/2 sm:w-1/4 sm:flex-1 lg:w-auto">
            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Status:</dt>
            <dd class="mt-1.5 inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
              <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"></path>
              </svg>
              Completed
            </dd>
          </dl>
          <button
            type="button"
            id="processButton"
            onclick="handleProcessing(this)"
            data-modal-target="accountInformationModal2"
            data-modal-toggle="accountInformationModal2"
            class="inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 sm:w-auto"
          >
            <svg class="-ms-0.5 me-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"></path>
            </svg>
            <span>Process</span>
          </button>

          <script>
            function handleProcessing(button) {
              // Ganti isi tombol jadi "Processed"
              button.innerHTML = `
                <svg class="-ms-0.5 me-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>Processed</span>
              `;
              
              // Opsional: menonaktifkan tombol setelah diklik
              button.disabled = true;
              button.classList.add('bg-green-600', 'hover:bg-green-700');
            }
          </script>
  
          {{-- <div class="w-full sm:flex sm:w-32 sm:items-center sm:justify-end sm:gap-4">
            <button
              id="actionsMenuDropdownModal12"
              data-dropdown-toggle="dropdownOrderModal12"
              type="button"
              class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 md:w-auto"
            >
              Actions
              <svg class="-me-0.5 ms-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"></path>
              </svg>
            </button>
            <div id="dropdownOrderModal12" class="z-10 hidden w-40 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom">
              <ul class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400" aria-labelledby="actionsMenuDropdown12">
                <li>
                  <a href="#" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4"></path>
                    </svg>
                    <span>Order again</span>
                  </a>
                </li>
                <li>
                  <a href="#" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"></path>
                      <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                    </svg>
                    Order details
                  </a>
                </li>
              </ul>
            </div>
          </div> --}}
        </div>
        <div class="flex flex-wrap items-center gap-y-4 pt-4 md:pt-5">
          <dl class="w-1/2 sm:w-48">
            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Order ID:</dt>
            <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
              <a href="#" class="hover:underline">#FWB12546212</a>
            </dd>
          </dl>
  
          <dl class="w-1/2 sm:w-1/4 md:flex-1 lg:w-auto">
            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Date:</dt>
            <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">18.10.2024</dd>
          </dl>
  
          <dl class="w-1/2 sm:w-1/5 md:flex-1 lg:w-auto">
            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Price:</dt>
            <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">$756</dd>
          </dl>
  
          <dl class="w-1/2 sm:w-1/4 sm:flex-1 lg:w-auto">
            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Status:</dt>
            <dd class="mt-1.5 inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
              <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"></path>
              </svg>
              Completed
            </dd>
          </dl>
          <button
            type="button"
            id="processButton"
            onclick="handleProcessing(this)"
            data-modal-target="accountInformationModal2"
            data-modal-toggle="accountInformationModal2"
            class="inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 sm:w-auto"
          >
            <svg class="-ms-0.5 me-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"></path>
            </svg>
            <span>Process</span>
          </button>

          <script>
            function handleProcessing(button) {
              // Ganti isi tombol jadi "Processed"
              button.innerHTML = `
                <svg class="-ms-0.5 me-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>Processed</span>
              `;
              
              // Opsional: menonaktifkan tombol setelah diklik
              button.disabled = true;
              button.classList.add('bg-green-600', 'hover:bg-green-700');
            }
          </script>

  
          {{-- <div class="w-full sm:flex sm:w-32 sm:items-center sm:justify-end sm:gap-4">
            <button
              id="actionsMenuDropdownModal13"
              data-dropdown-toggle="dropdownOrderModal13"
              type="button"
              class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 md:w-auto"
            >
              Actions
              <svg class="-me-0.5 ms-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"></path>
              </svg>
            </button>
            <div id="dropdownOrderModal13" class="z-10 hidden w-40 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom">
              <ul class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400" aria-labelledby="actionsMenuDropdown13">
                <li>
                  <a href="#" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4"></path>
                    </svg>
                    <span>Order again</span>
                  </a>
                </li>
                <li>
                  <a href="#" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"></path>
                      <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                    </svg>
                    Order details
                  </a>
                </li>
              </ul>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
    <!-- Account Information Modal -->
    <div id="accountInformationModal2" tabindex="-1" aria-hidden="true" class="max-h-auto fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden antialiased md:inset-0">
  <div class="relative max-h-full w-full max-w-lg p-4">
    <!-- Modal content -->
    <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
      <!-- Modal header -->
      <div class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-700 md:p-5">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Seller Profile</h3>
        <button type="button" class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="accountInformationModal2">
          <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      
      <!-- Modal body -->
       <form class="p-4 md:p-5" method="POST" action="{{ route('seller.profile.update') }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

        <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
          <!-- Shop Owner Name -->
          <div class="col-span-2 sm:col-span-1">
            <label for="owner_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Shop Owner Name*</label>
            <input type="text" id="contact_person" name="contact_person" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" value="{{ $seller->contact_person }}" required />
          </div>

          <!-- Shop Name -->
          <div class="col-span-2 sm:col-span-1">
            <label for="shop_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Shop Name*</label>
            <input type="text" id="store_name" name="store_name" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" value="{{ $seller->store_name }}" required />
          </div>

          <!-- Shop Address -->
          <div class="col-span-2">
            <label for="shop_address" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Shop Address*</label>
            <textarea id="seller_address" name="seller_address" rows="3" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" required>{{ $seller->seller_address }}</textarea>
          </div>

          <!-- Email -->
          <div class="col-span-2 sm:col-span-1">
            <label for="email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Email Address*</label>
            <input type="email" id="email" name="email" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" value="{{ $seller->email }}" required />
          </div>

          <!-- Phone Number -->
          <div class="col-span-2 sm:col-span-1">
            <label for="phone_number" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Phone Number*</label>
            <div class="flex">
              
              <input type="tel" id="contact_number" name="contact_number" class="block w-full min-w-0 flex-1 rounded-none rounded-r-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" value="{{ $seller->contact_number }}" required />
            </div>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between border-t border-gray-200 pt-4 dark:border-gray-700 md:pt-5">
          <button type="button" id="cancelBtn" class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Cancel</button>
          <button type="submit" class="rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Save Changes</button>
        </div>
      </form>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          const form = document.getElementById('sellerProfileForm');
          const cancelBtn = document.getElementById('cancelBtn');

          // Set nilai awal form sesuai data user
          function initializeForm() {
            document.getElementById('contact_person').value = userData.contact_person;
            document.getElementById('store_name').value = userData.store_name;
            document.getElementById('seller_address').value = userData.seller_address;
            document.getElementById('email').value = userData.email;
            document.getElementById('contact_number').value = userData.contact_number;
          }

          // Inisialisasi form saat pertama kali load
          initializeForm();

          // Tombol cancel - kembalikan ke nilai awal
          cancelBtn.addEventListener('click', function() {
            if(confirm('Apakah Anda yakin ingin membatalkan perubahan?')) {
              initializeForm();
            }
          });

          // Submit form
          form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validasi form
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
              if (!field.value.trim()) {
                field.classList.add('border-red-500');
                isValid = false;
              } else {
                field.classList.remove('border-red-500');
              }
            });

            if (isValid) {
              // Update data user dengan nilai baru dari form
              userData.owner_name = document.getElementById('contact_person').value;
              userData.shop_name = document.getElementById('store_name').value;
              userData.shop_address = document.getElementById('seller_address').value;
              userData.email = document.getElementById('email').value;
              userData.phone_number = document.getElementById('contact_number').value;
              
              // Simpan perubahan (simulasi)
              console.log('Data yang diperbarui:', userData);
              alert('Perubahan berhasil disimpan!');
              
              // Untuk implementasi nyata, gunakan:
              // fetch('/update-profile', {
              //   method: 'POST',
              //   headers: {
              //     'Content-Type': 'application/json',
              //   },
              //   body: JSON.stringify(userData)
              // })
              // .then(response => response.json())
              // .then(data => {
              //   alert('Profil berhasil diperbarui!');
              //   // Update data lokal jika perlu
              // })
              // .catch(error => {
              //   console.error('Error:', error);
              //   alert('Gagal menyimpan perubahan');
              // });
            } else {
              alert('Harap isi semua field yang wajib diisi!');
            }
          });
        });
      </script>


    <div id="deleteOrderModal" tabindex="-1" aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-modal w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 md:h-full">
        <div class="relative h-full w-full max-w-md p-4 md:h-auto">
          <!-- Modal content -->
          <div class="relative rounded-lg bg-white p-4 text-center shadow dark:bg-gray-800 sm:p-5">
            <button type="button" class="absolute right-2.5 top-2.5 ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteOrderModal">
              <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              <span class="sr-only">Close modal</span>
            </button>
            <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100 p-2 dark:bg-gray-700">
              <svg class="h-8 w-8 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
              </svg>
              <span class="sr-only">Danger icon</span>
            </div>
            <p class="mb-3.5 text-gray-900 dark:text-white"><a href="#" class="font-medium text-primary-700 hover:underline dark:text-primary-500">@heleneeng</a>, are you sure you want to delete this order from your account?</p>
            <p class="mb-4 text-gray-500 dark:text-gray-300">This action cannot be undone.</p>
            <div class="flex items-center justify-center space-x-4">
              <button data-modal-toggle="deleteOrderModal" type="button" class="rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-600">No, cancel</button>
              <button type="submit" class="rounded-lg bg-red-700 px-3 py-2 text-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Yes, delete</button>
            </div>
          </div>
        </div>
      </div>
</x-app-layout>
