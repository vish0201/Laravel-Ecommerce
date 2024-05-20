<?php



use App\Http\Controllers\ProductCategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('categories')->group(function () {
    Route::get('/', [ProductCategoryController::class, 'show'])->name('category.category');
    Route::get('/create', [ProductCategoryController::class, 'create'])->name('category.create');
    Route::post('/store', [ProductCategoryController::class, 'store'])->name('category.store');
    Route::delete('/{category}', [ProductCategoryController::class, 'delete'])->name('category.delete');
    Route::get('/{category}/edit', [ProductCategoryController::class, 'edit'])->name('category.edit');
    Route::put('/{category}', [ProductCategoryController::class, 'update'])->name('category.update');
    Route::post('/category/{category}/toggle-featured', [ProductCategoryController::class, 'toggleFeatured'])->name('category.toggle-featured');
    Route::get('/products/{id?}', [ProductCategoryController::class, 'showProducts'])->name('category.products');
    


});
