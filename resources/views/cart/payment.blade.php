<x-app-layout>
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script>
    function formatRupiah(angka) {
      return angka.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
    }

    function setShippingFee() {
      const checkedRadio = document.querySelector('input[name="delivery_package"]:checked');
      const pickUpElement = document.getElementById('pick-up');
      const totalElement = document.getElementById('total');
      const buttonProceed = document.getElementById('button-proceed');

      if (checkedRadio && pickUpElement && totalElement) {
        const cost = parseFloat(checkedRadio.value);
        pickUpElement.textContent = `${formatRupiah(cost)}`;

        const total = {{ $total }};
        const total_final = total + cost;

        totalElement.textContent = formatRupiah(total_final);

        buttonProceed.disabled = false
        buttonProceed.className = "flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
      }
    }
  </script>

  <section class="min-h-screen bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <form action="{{ route('checkout') }}" method="POST" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
      @csrf
      <ol class="items-center flex w-full max-w-2xl text-center text-sm font-medium text-gray-500 dark:text-gray-400 sm:text-base">
        <li class="after:border-1 flex items-center text-primary-700 after:mx-6 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200 dark:text-primary-500 dark:after:border-gray-700 sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-10">
          <span class="flex items-center after:mx-2 after:text-gray-200 after:content-['/'] dark:after:text-gray-500 sm:after:hidden">
            <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            Cart
          </span>
        </li>

        <li class="after:border-1 flex items-center text-primary-700 after:mx-6 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200 dark:text-primary-500 dark:after:border-gray-700 sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-10">
          <span class="flex items-center after:mx-2 after:text-gray-200 after:content-['/'] dark:after:text-gray-500 sm:after:hidden">
            <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            Checkout
          </span>
        </li>

        <li class="flex shrink-0 items-center">
          <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          Order summary
        </li>
      </ol>

      <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16">
        <div class="min-w-0 flex-1 space-y-8">
          <div class="space-y-4">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Delivery Address</h2>

            <div class="space-y-4">
              <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                @forelse ($addresses as $address)
                  <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                    <label for="address-{{ $address->id }}" class="flex items-start cursor-pointer">
                      <div class="flex h-5 items-center">
                        <input
                          id="address-{{ $address->id }}"
                          aria-describedby="dhl-text"
                          {{ $address->is_primary ? 'checked' : '' }}
                          type="radio"
                          name="selected_address"
                          value="{{ $address->city }}"
                          class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                        />
                        <input hidden type="number" name="phone" id="" value="{{ $address->phone }}">
                      </div>
                      <div class="ms-4 text-sm">
                        <span class="font-medium leading-none text-gray-900 dark:text-white"> {{ $address->name }} </span>
                        <p class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400"> {{ $address->address }} </p>
                        <p class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400"> {{ $address->postcode }} </p>
                      </div>
                    </label>
                  </div>
                @empty
                  <p class="mb-2 block text-sm font-medium text-red-500 dark:text-white"> No address found! </p>
                @endforelse

              </div>
            </div>

            <div class="sm:col-span-2">
              <a href="{{ route('add.new-address') }}" class="flex w-full items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                </svg>
                Add new address
              </a>
            </div>
          </div>

          <div class="space-y-4">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Delivery Methods</h3>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
              <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                <label for="dhl1" class="flex items-start cursor-pointer">
                  <div class="flex h-5 items-center">
                    <input {{ $addresses->isEmpty() ? 'disabled' : '' }} id="dhl1" aria-describedby="dhl-text" type="radio" name="delivery-method" value="jne" class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"/>
                  </div>
                  <div class="ms-4 text-sm">
                    <span class="font-medium leading-none text-gray-900 dark:text-white"> JNE </span>
                    <p id="dhl-text" class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">Jalur Nugraha Ekakurir </p>
                  </div>
                </label>
              </div>

              <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                <label for="dhl2" class="flex items-start cursor-pointer">
                  <div class="flex h-5 items-center">
                    <input id="dhl2" {{ $addresses->isEmpty() ? 'disabled' : '' }} aria-describedby="dhl-text" type="radio" name="delivery-method" value="pos" class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"/>
                  </div>
                  <div class="ms-4 text-sm">
                    <span class="font-medium leading-none text-gray-900 dark:text-white"> POS </span>
                    <p id="dhl-text" class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">Pos Indonesia</p>
                  </div>
                </label>
              </div>

              <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                <label for="dhl3" class="flex items-start cursor-pointer">
                  <div class="flex h-5 items-center">
                    <input id="dhl3" {{ $addresses->isEmpty() ? 'disabled' : '' }} aria-describedby="dhl-text" type="radio" name="delivery-method" value="tiki" class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"/>
                  </div>
                  <div class="ms-4 text-sm">
                    <span class="font-medium leading-none text-gray-900 dark:text-white"> TIKI </span>
                    <p id="dhl-text" class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">Titipan Kilat</p>
                  </div>
                </label>
              </div>
            </div>
          </div>

          <div class="space-y-4">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Available Service</h3>
            <label for="service" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Pick one of the delivery method to see available services </label>

            <ul class="list-group list-group-flush available-services" style="display: block;">
              <li class="py-3 border-t font-bold" id="first-list">
                <div class="flex items-center">
                    <div class="w-8 lg:w-1/10"></div>
                    <div class="w-1/3 md:w-1/4 lg:w-1/3">
                        Service
                    </div>
                    <div class="w-1/4 md:w-1/6 lg:w-1/3">
                        Estimate Time
                    </div>
                    <div class="w-1/4 md:w-1/4 lg:w-1/4 text-lg-end text-start md:text-start">
                        Cost
                    </div>
                  </div>
              </li>

              <div class="text-center" id="loading" hidden>
                <div role="status">
                    <svg aria-hidden="true" class="mt-3 inline w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            </ul>
          </div>
        </div>

        <div class="mt-6 w-full space-y-6 sm:mt-8 lg:mt-0 lg:max-w-xs xl:max-w-md">
            <dl class="flex items-center justify-between gap-4">
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Subtotal</dt>
                <dd class="text-base font-medium text-gray-900 dark:text-white">Rp. {{ number_format($subtotal, 2) }}</dd>
            </dl>

            <dl class="flex items-center justify-between gap-4">
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Pick-Up</dt>
                <dd class="text-base font-medium text-gray-900 dark:text-white" id="pick-up">Rp. 0</dd>
            </dl>

            <dl class="flex items-center justify-between gap-4">
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tax</dt>
                <dd class="text-base font-medium text-gray-900 dark:text-white">Rp. {{ number_format($tax, 2) }}</dd>
            </dl>

            <dl class="flex items-center justify-between gap-4 py-3">
                <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                <dd class="text-base font-bold text-gray-900 dark:text-white" id="total">Rp. {{ number_format($total, 2) }}</dd>
            </dl>

          <div class="space-y-3">
            {{-- <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Proceed to Payment</button> --}}

            <button

            disabled type="submit" id="button-proceed" class="flex w-full items-center justify-center rounded-lg bg-gray-400 px-5 py-2.5 text-sm font-medium text-white cursor-not-allowed">Proceed to Payment</button>

            {{-- <p class="text-sm font-normal text-gray-500 dark:text-gray-400">One or more items in your cart require an account. <a href="#" title="" class="font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">Sign in or create an account now.</a>.</p> --}}
          </div>
        </div>
      </div>
    </form>
  </section>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
    const radios = document.getElementsByName('delivery-method');
    const radios2 = document.getElementsByName('selected_address');
    const ulServices = document.querySelector('.available-services');
    const loading = document.getElementById('loading');

    // Pastikan radios adalah array, karena getElementsByName() returns NodeList
    Array.from(radios).forEach(radio => {
      radio.addEventListener('change', () => {
        if (radio.checked) {
          // Disable semua radio lainnya saat ini
          Array.from(radios).forEach(r => {
            if (r !== radio) {
              r.disabled = true;
            }
          });

          // Bersihkan list kecuali list pertama
          const listItems = ulServices.querySelectorAll('li');
          for (let i = 1; i < listItems.length; i++) {
            listItems[i].remove();
          }

          loading.hidden = false;
          radio.disabled = true; // juga disable tombol yang dipilih, supaya tidak double klik

          const addressRadio = Array.from(radios2).find(r => r.checked);
          if (!addressRadio) {
            // Jika tidak ada alamat terpilih, aktifkan kembali semua radio
            Array.from(radios).forEach(r => r.disabled = false);
            loading.hidden = true;
            return;
          }

          fetch('/api/ongkos-kirim/164/' + addressRadio.value + '/' + {{ $weight }} + '/' + radio.value)
            .then(response => response.json())
            .then(data => {
              loading.hidden = true;

              // Aktifkan kembali semua radio
              Array.from(radios).forEach(r => r.disabled = false);
              // Jangan lupa aktifkan lagi radio yang dipilih
              radio.disabled = false;

              if (data['services'].length === 0) {
                ulServices.insertAdjacentHTML('beforeend', `
                  <li class="py-3 border-t">
                    <span class="text-red-600">No delivery service found, try another courier!</span>
                  </li>
                `);
              } else {
                for (let service of data['services']) {
                  ulServices.insertAdjacentHTML('beforeend', `
                    <li class="py-3 border-t" onclick="setShippingFee()">
                      <label class="py-3 border-t cursor-pointer">
                        <div class="flex items-center">
                          <div class="w-8 lg:w-1/10">
                            <input class="form-check-input" type="radio" name="delivery_package" value="${service['biaya']}">
                          </div>
                          <div class="w-1/3 md:w-1/4 lg:w-1/3">
                            ${service['description']}
                          </div>
                          <div class="w-1/4 md:w-1/6 lg:w-1/3">
                            <span class="">${service['etd']} hari</span>
                          </div>
                          <div class="w-1/4 md:w-1/4 lg:w-1/4 text-lg-end text-start md:text-start">
                            <span class="">${service['biaya']} IDR</span>
                          </div>
                        </div>
                      </label>
                    </li>
                  `);
                }
              }
            })
            .catch(() => {
              loading.hidden = true;
              // Aktifkan kembali semua radio
              Array.from(radios).forEach(r => r.disabled = false);
              // Jangan lupa aktifkan lagi radio yang dipilih
              radio.disabled = false;

              ulServices.insertAdjacentHTML('beforeend', `
                <li class="py-3 border-t">
                  <span class="text-red-600">No delivery service found, try another courier!</span>
                </li>
              `);
            });
        }
      });
    });
  });
  </script>
</x-app-layout>


