<x-app-layout>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <form action="#" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
          <div class="mx-auto max-w-3xl">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Order summary</h2>

            <div class="mt-6 sm:mt-8">
              <div class="relative overflow-x-auto border-b border-gray-200 dark:border-gray-800">
                <table class="w-full text-left font-medium text-gray-900 dark:text-white md:table-fixed">
                  <tbody class="divide-y divide-gray-200 dark:divide-gray-800">

                    <tr>
                      <td class="whitespace-nowrap py-4 md:w-[384px]">
                        <div class="flex items-center gap-4">
                          <a href="#" class="flex items-center aspect-square w-10 h-10 shrink-0">
                            <img class="h-auto w-full max-h-full dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/apple-watch-light.svg" alt="watch image" />
                            <img class="hidden h-auto w-full max-h-full dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/apple-watch-dark.svg" alt="watch image" />
                          <a href="#" class="hover:underline">Apple Watch SE</a>
                        </div>
                      </td>

                      <td class="p-4 text-base font-normal text-gray-900 dark:text-white">x2</td>

                      <td class="p-4 text-right text-base font-bold text-gray-900 dark:text-white">$799</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="mt-4 space-y-6">
                <h4 class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</h4>

                <div class="space-y-4">
                  <div class="space-y-2">
                    <dl class="flex items-center justify-between gap-4">
                      <dt class="text-gray-500 dark:text-gray-400">Original price</dt>
                      <dd class="text-base font-medium text-gray-900 dark:text-white">$6,592.00</dd>
                    </dl>

                    <dl class="flex items-center justify-between gap-4">
                      <dt class="text-gray-500 dark:text-gray-400">Store Pickup</dt>
                      <dd class="text-base font-medium text-gray-900 dark:text-white">$99</dd>
                    </dl>

                    <dl class="flex items-center justify-between gap-4">
                      <dt class="text-gray-500 dark:text-gray-400">Tax</dt>
                      <dd class="text-base font-medium text-gray-900 dark:text-white">$799</dd>
                    </dl>
                  </div>

                  <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                    <dt class="text-lg font-bold text-gray-900 dark:text-white">Total</dt>
                    <dd class="text-lg font-bold text-gray-900 dark:text-white">$7,191.00</dd>
                  </dl>
                </div>

                <div class="flex items-start sm:items-center">
                  <input id="terms-checkbox-2" type="checkbox" value="" class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                  <label for="terms-checkbox-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"> I agree with the <a href="#" title="" class="text-primary-700 underline hover:no-underline dark:text-primary-500">Terms and Conditions</a> of use of the Flowbite marketplace </label>
                </div>

                <div class="gap-4 sm:flex sm:items-center">
                  <button type="submit" class="mt-4 flex w-full items-center justify-center rounded-lg bg-primary-700  px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300  dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 sm:mt-0">Back to history order</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </section>

      <div id="billingInformationModal" tabindex="-1" aria-hidden="true" class="antialiased fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-auto w-full max-h-full items-center justify-center overflow-y-auto overflow-x-hidden antialiased md:inset-0">
        <div class="relative max-h-auto w-full max-h-full max-w-lg p-4">
        </div>
      </div>

</x-app-layout>
