<?php

use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login'); 
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login'); 
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});
