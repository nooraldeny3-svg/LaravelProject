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

// ── PUBLIC ──────────────────────────────────────────────────
Route::get('/',                   [HomeController::class, 'index'])->name('home');
Route::get('/products',           [HomeController::class, 'products'])->name('products');
Route::get('/categories',         [HomeController::class, 'categories'])->name('categories');
Route::get('/products/{product}', [HomeController::class, 'productDetail'])->name('products.show');

// ── CART ─────────────────────────────────────────────────────
Route::get('/cart',                     [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}',      [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');

// ── CHECKOUT & ORDERS (auth required) ───────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/checkout',  [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('checkout.store');
    Route::get('/orders/{orderId}/confirmation', [OrderController::class, 'confirmation'])->name('orders.confirmation');
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.index');

    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ── ADMIN ────────────────────────────────────────────────────
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminHomeController::class, 'index'])->name('home');
        Route::resource('categories', CategoryController::class);
        Route::resource('products', AdminProductController::class);
        Route::get('orders',                  [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}',          [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    });

// ── AUTH (Breeze) ────────────────────────────────────────────
require __DIR__.'/auth.php';
