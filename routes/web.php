<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChatController;

use Illuminate\Support\Facades\Auth;

Route::get('/cs-chat', function () {
    if (Auth::user()->is_cs ?? false) {
        return view('cs_chat');
    }
    abort(403);
})->middleware(['auth'])->name('cs.chat');
Route::middleware(['auth'])->group(function () {
    Route::get('/cs-chat', function () {
        if (Auth::user()->is_cs ?? false) {
            return view('cs_chat');
        }
        abort(403);
    })->name('cs.chat');
});

// Route::get('/', function () {
//     return view('dashboard');
// });

Route::get('/', [DashboardController::class, 'index']);

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart routes
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::patch('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/callback', [CheckoutController::class, 'callback'])->name('checkout.callback');

    // Order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');
});


// Customer product route
Route::get('/products', [CustomerProductController::class, 'index'])->name('customer.products.index');
Route::get('/categories', [CustomerProductController::class, 'categoriesIndex'])->name('customer.categories.index');
Route::get('/products/category/{categorySlug}', [CustomerProductController::class, 'productsByCategory'])->name('customer.products.byCategory');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
