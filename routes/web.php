<?php

use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{id}', [CartController::class, 'create'])->name('cart.add');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

    Route::get('/seller/setup', [SellerController::class, 'setup'])->name('seller.register');
    Route::post('/seller', [SellerController::class, 'store'])->name('seller.store');


    Route::middleware('seller')->group(function () {
        Route::get('/seller/index', [SellerController::class, 'index'])->name('seller.profile');
        Route::get('/seller/product', [SellerController::class, 'product'])->name('seller.product');
    });
});

require __DIR__.'/auth.php';
