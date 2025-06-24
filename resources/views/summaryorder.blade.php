<x-app-layout>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <form action="#" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
          <div class="mx-auto max-w-3xl">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Order summary</h2>

            <div class="mt-6 sm:mt-8">
                @foreach ($order_items as $item)
              <div class="relative overflow-x-auto border-b border-gray-200 dark:border-gray-800">
                <table class="w-full text-left font-medium text-gray-900 dark:text-white md:table-fixed">
                  <tbody class="divide-y divide-gray-200 dark:divide-gray-800">

                    <tr>
                      <td class="whitespace-nowrap py-4 md:w-[384px]">
                        <div class="flex items-center gap-4">
                          <a href="#" class="flex items-center aspect-square w-10 h-10 shrink-0">
                            <img class="h-auto w-full max-h-full dark:hidden" src="{{ $item->product->image }}"/>
                          <a href="#" class="hover:underline">{{ $item->product->name ?? 'Unknown Product' }}</a>
                        </div>
                      </td>

                      <td class="p-4 text-base font-normal text-gray-900 dark:text-white">x{{ $item->quantity }}</td>

                      <td class="   text-right text-base font-bold text-gray-900 dark:text-white">Rp {{ $item->product->price * $item->quantity }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="space-y-4">
                @endforeach
                <div class="space-y-2">
                    {{-- <dl class="flex items-center justify-between gap-4">
                      <dt class="text-gray-500 dark:text-gray-400">
                        {{ $item->product->name ?? 'Unknown Product' }} x {{ $item->quantity }}
                      </dt>
                      <dd class="text-base font-medium text-gray-900 dark:text-white">
                        ${{ number_format($item->quantity, 2) }}
                      </dd>
                    </dl> --}}

                  <dl class="flex items-center justify-between gap-4">
                    <dt class="text-gray-500 dark:text-gray-400">Store Pickup</dt>
                    <dd class="text-base font-medium text-gray-900 dark:text-white">Rp {{ $order->pickup_fee }}</dd>
                  </dl>

                  <dl class="flex items-center justify-between gap-4">
                    <dt class="text-gray-500 dark:text-gray-400">Tax</dt>
                    <dd class="text-base font-medium text-gray-900 dark:text-white">
                      Rp {{ $order->tax }}
                    </dd>
                  </dl>

                </div>

                <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                  <dt class="text-lg font-bold text-gray-900 dark:text-white">Total</dt>
                  <dd class="text-lg font-bold text-gray-900 dark:text-white">
                    Rp {{$order->total_price }}
                  </dd>
                </dl>
              </div>

            </div>
          </div>
        </form>
      </section>

      <div id="billingInformationModal" tabindex="-1" aria-hidden="true" class="antialiased fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-auto w-full max-h-full items-center justify-center overflow-y-auto overflow-x-hidden antialiased md:inset-0">
        <div class="relative max-h-auto w-full max-h-full max-w-lg p-4">
        </div>
      </div>

      <script>
        function handleFinishConfirm() {
          const checkbox = document.getElementById('terms-checkbox-2');

          if (!checkbox.checked) {
            alert('You must agree to the Terms and Conditions before finishing the order.');
            return false;
          }

          const confirmation = confirm('Are you sure you want to finish the order?');
          if (confirmation) {
            window.location.href = "{{ route('dashboard') }}";
          }

          return false; // prevent default if not confirmed
        }
      </script>


</x-app-layout>
