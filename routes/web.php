<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ─────────────────────────────────────────────
//  PUBLIC ROUTES (no login required)
// ─────────────────────────────────────────────

Route::get('/',         [HomeController::class, 'index'])->name('home');
Route::get('/tours',    [HomeController::class, 'tours'])->name('tours');
Route::get('/cities',   [HomeController::class, 'cities'])->name('cities');

// Single tour detail page — uses Laravel's route-model binding for the Product
Route::get('/tours/{product}', [HomeController::class, 'tourDetail'])->name('tours.show');

// ─────────────────────────────────────────────
//  CART ROUTES (session-based, no login needed to browse)
// ─────────────────────────────────────────────

Route::get('/cart',                     [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}',      [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');

// ─────────────────────────────────────────────
//  CHECKOUT & MY BOOKINGS (login required)
// ─────────────────────────────────────────────

Route::middleware('auth')->group(function () {
    Route::get('/checkout',  [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('checkout.store');
    Route::get('/orders/{orderId}/confirmation', [OrderController::class, 'confirmation'])->name('orders.confirmation');
    Route::get('/my-bookings', [OrderController::class, 'myOrders'])->name('orders.index');

    // Breeze profile routes (keep these so Breeze auth works)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ─────────────────────────────────────────────
//  ADMIN ROUTES (login + is_admin required)
// ─────────────────────────────────────────────

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [AdminHomeController::class, 'index'])->name('home');

        // City / Category CRUD — resource() generates all 7 RESTful routes automatically
        Route::resource('categories', CategoryController::class);

        // Tour / Product CRUD
        Route::resource('products', AdminProductController::class);

        // Order management (no create/edit — admin only views and changes status)
        Route::get('orders',            [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}',    [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    });

// ─────────────────────────────────────────────
//  AUTH ROUTES (provided by Laravel Breeze)
// ─────────────────────────────────────────────

require __DIR__.'/auth.php';
