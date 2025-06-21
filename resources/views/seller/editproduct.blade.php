<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Product
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

            <!-- Edit Form -->
            <form action="{{ route('seller.products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
                  class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                @csrf
                @method('PUT')

                <div class="grid gap-6 sm:grid-cols-3">
                    <!-- Left Column -->
                    <div class="space-y-6 sm:col-span-2">
                        <!-- Product Name -->
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Product Name
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type product name" required>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Description
                            </label>
                            <textarea id="description" name="description" rows="8"
                                class="block w-full px-4 py-3 text-sm text-gray-800 bg-white border border-gray-200 rounded-lg focus:ring-0 dark:bg-gray-800 dark:text-white dark:border-gray-600"
                                placeholder="Write product description here" required>{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Stock -->
                        <div>
                            <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Stock
                            </label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Product Stock" required>
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Category
                            </label>
                            <select name="category_id" id="category_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Price
                            </label>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="0.00" required>
                        </div>
                        {{-- weight --}}
                        <div>
                            <label for="weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Weight (grams)</label>
                            <input type="number" name="weight" id="weight" step="0.01" min="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type product weight" required>
                        </div>


                    </div>
                </div>
                <div class="mb-4">
                    <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Images</span>
                    <div class="flex justify-center items-center w-full">
                        <label for="dropzone-file"
                            class="flex flex-col justify-center items-center w-full h-64 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col justify-center items-center pt-5 pb-6">
                                <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none"
                                    stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                    <span class="font-semibold">Click to upload</span>
                                    or drag and drop
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                    800x400px)</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" name="product_image">

                        </label>
                    </div>
                    <div id="preview-container"></div>
                </div>
                <script>
                    const dropzoneFile = document.getElementById('dropzone-file');
                    const previewContainer = document.getElementById('preview-container');

                    dropzoneFile.addEventListener('change', function(event) {
                        const file = event.target.files[0];
                        if (file) {
                            const reader = new FileReader();

                            reader.onload = function(e) {
                                // Clear old content
                                previewContainer.innerHTML = '';

                                // Add classes only when an image is selected
                                previewContainer.className = 'mt-8 shadow-md rounded-lg p-2 bg-white dark:bg-gray-800';

                                // Create image preview
                                const imgPreview = document.createElement('img');
                                imgPreview.src = e.target.result;
                                imgPreview.classList.add('mx-auto', 'rounded-lg', 'max-h-60');

                                // Create file name display
                                const fileNameDisplay = document.createElement('p');
                                fileNameDisplay.textContent = `Selected file: ${file.name}`;
                                fileNameDisplay.classList.add('mt-2', 'text-sm', 'text-center', 'text-gray-500', 'dark:text-gray-400');

                                // Append to container
                                previewContainer.appendChild(imgPreview);
                                previewContainer.appendChild(fileNameDisplay);
                            };

                            reader.readAsDataURL(file);
                        } else {
                            // No file selected => remove classes
                            previewContainer.className = '';
                            previewContainer.innerHTML = '';
                        }
                    });
                </script>

                <!-- Action Buttons -->
                <div class="flex gap-4 mt-6">
                    <button type="submit"
                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Update Product
                    </button>

                    <a href="{{ route('seller.product') }}"
                        class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-800">
                        Cancel
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
