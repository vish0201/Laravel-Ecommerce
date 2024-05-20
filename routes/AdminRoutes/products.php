<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;





Route::prefix('products')->group(function () {
    Route::get('/create', [ProductController::class , 'create'])->name('product.create');
    Route::get('/allproduct', [ProductController::class , 'getallproducts'])->name('product.product');
    Route::post('/store', [ProductController::class , 'store'])->name('product.store');
    Route::delete('/{product}', [ProductController::class , 'delete'])->name('product.delete');
    Route::post('/product/{product}/toggle-featured', [ProductController::class, 'toggleFeatured'])->name('product.toggle-featured');
});
