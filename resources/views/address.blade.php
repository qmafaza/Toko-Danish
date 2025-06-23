<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add New Address
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Error Message -->
            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Success Message -->
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('address.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                @csrf
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                      <label for="name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Label Alamat </label>
                      <input type="text" name="name" id="your_name" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="" required />
                    </div>
      
                    <div>
                      <label for="address" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Alamat </label>
                      <input type="text" name="address" id="your_email" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="" required />
                    </div>
      
                    <div>
                      <div class="mb-2 flex items-center gap-2">
                        <label for="province" class="block text-sm font-medium text-gray-900 dark:text-white"> Provinsi </label>
                      </div>
                      <select id="province-select" name="province" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                      </select>
                    </div>
      
                    <div>
                      <div class="mb-2 flex items-center gap-2">
                        <label for="city" class="block text-sm font-medium text-gray-900 dark:text-white"> Kota </label>
                      </div>
                      <select id="city-select" name="city" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                      </select>
                    </div>
      
                    <div>
                      <label for="phone-input-3" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> No Telp </label>
                      <div class="flex items-center">
                        <button id="dropdown-phone-button-3" disabled
                            data-dropdown-toggle="dropdown-phone-3"
                            class="flex items-center rounded-s-lg border border-gray-300 bg-gray-100 px-4 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                            <svg width="24" height="16" viewBox="0 0 24 16" xmlns="http://www.w3.org/2000/svg" class="me-2">
                            <rect width="24" height="8" fill="#d52b1e"/>
                            <rect y="8" width="24" height="8" fill="#fff"/>
                            </svg>
                            +62
                        </button>
                        <div id="dropdown-phone-3" class="z-10 hidden w-56 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700">
                          <ul class="p-2 text-sm font-medium text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-phone-button-2">
                          </ul>
                        </div>
                        <div class="relative w-full">
                          <input type="text" id="phone-input" name="phone" class="z-20 block w-full rounded-e-lg border border-s-0 border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:border-s-gray-700  dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500" placeholder="" required />
                        </div>
                      </div>
                    </div>
      
                    <div>
                        <label for="postcode" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Kode Pos</label>
                        <input type="number" id="postcode" readonly name="postcode" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="" />
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 mt-6">
                    <button type="submit"
                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Add Address
                    </button>
                    
                    <a href="{{ route('cart.checkout') }}"
                        class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-800">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
        const selectElement = document.getElementById('province-select');
        const selectElement2 = document.getElementById('city-select');
        const postcode = document.getElementById('postcode');

        // Inisialisasi Choices
        const choices = new Choices(selectElement, {
            searchEnabled: true,
            shouldSort: false,
            placeholder: true,
            placeholderValue: 'Pilih Provinsi',
        });

        const choices2 = new Choices(selectElement2, {
            searchEnabled: true,
            shouldSort: false,
            placeholder: true,
            placeholderValue: 'Pilih Kota',
        });

        // Variabel untuk menyimpan data kota secara lengkap
        let kotaData = [];

        // Ambil provinsi
        fetch('/api/provinces')
            .then(response => response.json())
            .then(data => {
            choices.clearChoices();
            choices.setChoices(data.map(prov => ({
                value: prov.province_id,
                label: prov.province,
            })), 'value', 'label', true);
            })
            .catch(error => console.error('Error fetching provinces:', error));

        // Event listen saat pilih provinsi
        selectElement.addEventListener('change', () => {
            const provId = selectElement.value;

            // Reset pilihan kota dan input postcode
            choices2.clearChoices();
            choices2.setChoices([], 'value', 'label', true);
            selectElement2.value = '';
            postcode.value = '';
            selectElement2.disabled = true;

            if (provId) {
            fetch(`/api/cities-by-province/${provId}`)
                .then(res => res.json())
                .then(cities => {
                // Simpan data lengkap kota
                kotaData = cities;

                // Set choices kota
                choices2.setChoices(cities.map(city => ({
                    value: city.city_id,
                    label: city.city_name,
                })), 'value', 'label', true);

                selectElement2.disabled = false;
                });
            }
        });

        // Tambahkan event ketika pengguna memilih kota di Choices.js
        selectElement2.addEventListener('change', () => {
            const selectedCityId = choices2.getValue(true); // Ambil value terpilih

            // Cari data kota lengkap dari array kotaData
            const kotaDipilih = kotaData.find(k => k.city_id === selectedCityId);
            if (kotaDipilih && kotaDipilih.postal_code) {
            postcode.value = kotaDipilih.postal_code;
            } else {
            postcode.value = '';
            }
        });
        });
      </script>
</x-app-layout>