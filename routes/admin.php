<?php

use App\Http\Controllers\Auth\AdminAuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('admin/login', [AdminAuthenticatedSessionController::class, 'create'])
                ->name('admin.login');

    Route::post('admin/login', [AdminAuthenticatedSessionController::class, 'store'])
                ->name('admin.login.post');
});

Route::middleware('auth:admin')->group(function () {
    Route::post('admin/logout', [AdminAuthenticatedSessionController::class, 'destroy'])
                ->name('admin.logout');

    Route::get('admin/dashboard', function () {
        return view('admin.dashboard'); // You'll need to create this view
    })->name('admin.dashboard');
    // Route::get('admin/produk', function () {
    //     return view('admin.product'); // You'll need to create this view
    // })->name('admin.produk');

    Route::resource('admin/categories', CategoryController::class)->names('admin.categories');
    Route::resource('admin/products', ProductController::class)->names('admin.products');
});
