<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Product') }}
            </h2>
        </div>
    </x-slot>

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

<!-- Detail Produk -->
<section class="py-8 bg-white md:py-16 dark:bg-gray-900 antialiased">
  <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
    <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
      <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
        <img class="w-full block dark:hidden" src="{{ $product->image }}" alt="{{ $product->name }}"/>
        <img class="w-full hidden dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg" alt="" />
      </div>

      <div class="mt-6 sm:mt-8 lg:mt-0">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
          {{ $product->name }}
        </h1>

        <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
          <div>
            <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
              Rp {{ number_format($product->price) }}
            </p>
            <!-- Seller information added here -->
            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
              Sold by: <span class="font-medium">{{ $product->seller->store_name }}</span>
              <br>
              Weight: <span class="font-medium">{{ $product->weight }} g </span>
            </p>
          </div>

          @php
            $averageRating = $product->ratings->avg('rating');
            $ratingCount = $product->ratings->count();
            $fullStars = floor($averageRating);
            $hasHalfStar = $averageRating - $fullStars >= 0.5;
          @endphp

          <div class="flex items-center gap-2 mt-2 sm:mt-0">
            <div class="flex items-center gap-1">
              @for($i = 1; $i <= 5; $i++)
                @if($i <= $fullStars)
                  <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                  </svg>
                @elseif($i == $fullStars + 1 && $hasHalfStar)
                  <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                  </svg>
                @else
                  <svg class="w-4 h-4 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                  </svg>
                @endif
              @endfor
            </div>
            <p class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400">
              ({{ number_format($averageRating, 1) }})
            </p>

          </div>
        </div>

        <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
          <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4 sm:mt-0 flex items-center justify-center">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" title="Add to Cart"
              class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center justify-center">
              <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
              </svg>
              Add to cart
            </button>
          </form>
        </div>

        <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />

        <p class="mb-6 text-gray-500 dark:text-gray-400">
          {{ $product->description }}
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Bagian review -->
<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
  <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <!-- Review Header with Stats -->
    <div class="flex items-center gap-2">
      <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Reviews</h2>
      <div class="mt-2 flex items-center gap-2 sm:mt-0">
        <div class="flex items-center gap-0.5">
          @php
            $averageRating = $product->ratings->avg('rating');
            $fullStars = floor($averageRating);
            $hasHalfStar = $averageRating - $fullStars >= 0.5;
          @endphp

          @for($i = 1; $i <= 5; $i++)
            @if($i <= $fullStars)
              <svg class="h-4 w-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
              </svg>
            @elseif($i == $fullStars + 1 && $hasHalfStar)
              <svg class="h-4 w-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
              </svg>
            @else
              <svg class="h-4 w-4 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
              </svg>
            @endif
          @endfor
        </div>
        <p class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400">
          ({{ number_format($averageRating, 1) }})
        </p>
        <a href="#" class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline dark:text-white">
          {{ $product->ratings->count() }} Reviews
        </a>
      </div>
    </div>

    <!-- Rating Summary -->
    <div class="my-6 gap-8 sm:flex sm:items-start md:my-8">
      <div class="shrink-0 space-y-4">
        <p class="text-2xl font-semibold leading-none text-gray-900 dark:text-white">
          {{ number_format($averageRating, 2) }} out of 5
        </p>
        <button type="button"
                data-modal-target="review-modal"
                data-modal-toggle="review-modal"
                class="mb-2 me-2 rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
          Write a review
        </button>
      </div>

      <!-- Rating Distribution -->
      <div class="mt-6 min-w-0 flex-1 space-y-3 sm:mt-0">
        @php
          $ratingCounts = [
            5 => $product->ratings->where('rating', 5)->count(),
            4 => $product->ratings->where('rating', 4)->count(),
            3 => $product->ratings->where('rating', 3)->count(),
            2 => $product->ratings->where('rating', 2)->count(),
            1 => $product->ratings->where('rating', 1)->count()
          ];
          $totalRatings = $product->ratings->count();
        @endphp

        @foreach([5,4,3,2,1] as $stars)
        <div class="flex items-center gap-2">
          <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">{{ $stars }}</p>
          <svg class="h-4 w-4 shrink-0 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
          </svg>
          <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
            <div class="h-1.5 rounded-full bg-yellow-300"
                 style="width: {{ $totalRatings > 0 ? ($ratingCounts[$stars] / $totalRatings * 100) : 0 }}%">
            </div>
          </div>
          <span class="w-8 shrink-0 text-right text-sm font-medium leading-none text-gray-700 dark:text-gray-300 sm:w-auto sm:text-left">
            {{ $ratingCounts[$stars] }} <span class="hidden sm:inline">reviews</span>
          </span>
        </div>
        @endforeach
      </div>
    </div>

    <!-- Review Items - Show ALL reviews -->
    <div class="mt-6 divide-y divide-gray-200 dark:divide-gray-700">
      @forelse($product->ratings as $rating)
      <div class="gap-3 py-6 sm:flex sm:items-start">
        <div class="shrink-0 space-y-2 sm:w-48 md:w-72">
          <div class="flex items-center gap-0.5">
            @for($i = 1; $i <= 5; $i++)
              <svg class="h-4 w-4 {{ $i <= $rating->rating ? 'text-yellow-300' : 'text-gray-300 dark:text-gray-500' }}"
                   aria-hidden="true"
                   xmlns="http://www.w3.org/2000/svg"
                   width="24"
                   height="24"
                   fill="currentColor"
                   viewBox="0 0 24 24">
                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
              </svg>
            @endfor
          </div>

          <div class="space-y-0.5">
            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $rating->user->name }}</p>
            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">
              {{ $rating->created_at->format('F j, Y \a\t H:i') }}
            </p>
          </div>
        </div>

        <div class="mt-4 min-w-0 flex-1 space-y-4 sm:mt-0">
          <p class="text-base font-normal text-gray-500 dark:text-gray-400">
            {{ $rating->rating_description }}
          </p>
        </div>
      </div>
      @empty
      <div class="py-6 text-center">
        <p class="text-gray-500 dark:text-gray-400">No reviews yet. Be the first to review!</p>
      </div>
      @endforelse
    </div>
  </div>
</section>



<!-- Add review modal -->
<div id="review-modal" tabindex="-1" aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 antialiased">
  <div class="relative max-h-full w-full max-w-2xl p-4">
    <!-- Modal content -->
    <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
      <!-- Modal header -->
      <div class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-700 md:p-5">
        <div>
          <h3 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">Add a review for:</h3>
          <a href="#" class="font-medium text-primary-700 hover:underline dark:text-primary-500">
            {{ $product->name }}
          </a>
        </div>
        <button type="button" class="absolute right-5 top-5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="review-modal">
          <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>

      <!-- Modal body -->
      <form action="{{ route('products.ratings.store', $product->id) }}" method="POST" class="p-4 md:p-5">
        @csrf

        <div class="mb-4 grid grid-cols-2 gap-4">
          <div class="col-span-2">
            <div class="flex items-center" id="rating-stars">
              @for($i = 1; $i <= 5; $i++)
                <svg class="h-6 w-6 cursor-pointer text-gray-300 star dark:text-gray-500"
                     data-rating="{{ $i }}"
                     aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="currentColor"
                     viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
              @endfor
              <span class="ms-2 text-lg font-bold text-gray-900 dark:text-white" id="rating-text">0 out of 5</span>
              <input type="hidden" id="rating-value" name="rating" value="0" required>
            </div>
            @error('rating')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <div class="col-span-2">
            <label for="rating_description" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Review description</label>
            <textarea id="rating_description"
                      name="rating_description"
                      rows="6"
                      class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                      required
                      placeholder="Share your experience with this product..."></textarea>
            @error('rating_description')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="border-t border-gray-200 pt-4 dark:border-gray-700 md:pt-5">
          <button type="submit" class="me-2 inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
            Add review
          </button>
          <button type="button" data-modal-toggle="review-modal" class="me-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
// Star rating functionality
document.addEventListener('DOMContentLoaded', function() {
  const stars = document.querySelectorAll('.star');
  const ratingText = document.getElementById('rating-text');
  const ratingValue = document.getElementById('rating-value');

  stars.forEach(star => {
    star.addEventListener('click', function() {
      const rating = parseInt(this.getAttribute('data-rating'));
      ratingValue.value = rating;
      ratingText.textContent = rating + ' out of 5';

      // Update star colors
      stars.forEach((s, index) => {
        if (index < rating) {
          s.classList.remove('text-gray-300', 'dark:text-gray-500');
          s.classList.add('text-yellow-300');
        } else {
          s.classList.remove('text-yellow-300');
          s.classList.add('text-gray-300', 'dark:text-gray-500');
        }
      });
    });
  });

  // When opening the modal, you would set the product info like this:
  // document.getElementById('product-name').textContent = productName;
  // document.getElementById('product-id').value = productId;
});
</script>

<!-- People Also Bought Section -->
<section class="py-8 bg-white dark:bg-gray-900">
  <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">People also bought</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @php
        // Get random products (assuming you have a collection of related products)
        $randomProducts = App\Models\Product::inRandomOrder()->limit(3)->get();
      @endphp

      @foreach($randomProducts as $product)
      <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
        <a href="{{ route('product.show', $product->id) }}" class="block p-4">
          <div class="flex justify-center">
            <img class="w-32 h-32 object-contain dark:hidden" src="{{ $product->image }}" alt="{{ $product->name }}" />
          </div>

          <div class="p-4">
            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 hover:underline">
              {{ $product->name }}
            </h4>
            <p class="text-gray-600 dark:text-gray-300 mb-4 text-sm">
              {{ Str::limit($product->description, 80) }}
            </p>
          </div>
        </a>

        <div class="px-4 pb-4">
          <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit"
                    class="w-full flex items-center justify-center bg-primary-600 hover:bg-primary-700 text-white py-2 px-4 rounded-lg transition-colors duration-300">
              <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                   width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7h-1M8 7h-.688M13 5v4m-2-2h4"/>
              </svg>
              Add to cart
            </button>
          </form>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>



    </body>
    </html>

</x-app-layout>
