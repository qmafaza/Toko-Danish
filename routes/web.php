<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('dashboard');
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

    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

    Route::get('/seller/setup', [SellerController::class, 'setup'])->name('seller.registerseller');
        Route::get('/seller/index', [SellerController::class, 'index'])->name('seller.sellerprofile');
});

require __DIR__.'/auth.php';
