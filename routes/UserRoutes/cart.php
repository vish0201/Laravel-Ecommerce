<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::prefix('cart')->group(function () {
    Route::post('/add', [CartController::class, "addToCart"])->name('cart.add');
    Route::get('/get', [CartController::class, "getCart"])->name('cart.get');
    Route::delete('/remove', [CartController::class, "removeFromCart"])->name('cart.remove');
    Route::get('/cart-items', [CartController::class, 'getCartPage'])->name('cart.page');
    Route::put('/cart/{id}', [CartController::class, 'updateCart'])->name('cart.update');
});
