<?php

use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductRatingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\PaymentController;
use App\Models\Category;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    $categories = Category::all();
    $products = Product::all()->take(15);

    return view('dashboard', compact('categories', 'products'));
})->name('dashboard');
// ->middleware(['auth', 'verified'])

Route::get('/product', function () {
    return view('product.show');
});

Route::get('/product/productcategory', function () {
    return view('product.productcategory');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{id}', [CartController::class, 'create'])->name('cart.add');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/update-quantity/{id}', [CartController::class, 'update_quantity'])->name('cart.update-quantity');
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/card/payment', [PaymentController::class, 'index'])->name('payment.index');

    Route::get('/cart/payment', [PaymentController::class, 'index'])->name('cart.checkout');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::get('/seller/setup', [SellerController::class, 'setup'])->name('seller.register');
    Route::post('/seller', [SellerController::class, 'store'])->name('seller.store');
    Route::put('/seller', [SellerController::class, 'update_profile'])->name('seller.profile.update');

    Route::post('/products/{product}/ratings', [ProductRatingController::class, 'store'])
    ->name('products.ratings.store');


    Route::middleware('seller')->group(function () {
        Route::get('/seller/index', [SellerController::class, 'index'])->name('seller.profile');
        Route::get('/seller/product', [SellerController::class, 'product'])->name('seller.product');
        Route::post('/seller/create', [SellerController::class, 'create_product'])->name('seller.create-product');
    });
});

require __DIR__.'/auth.php';
