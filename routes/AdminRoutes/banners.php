<?php


// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;

// Fetch all banners
Route::get('/banners', [BannerController::class, 'index'])->name('banners');

// Create a new banner
Route::post('/banners/create', [BannerController::class, 'store'])->name('banner.create');

// Fetch a single banner by ID
Route::get('/banners/{banner}', [BannerController::class, 'show']);

// Update a banner by ID
Route::put('/banners/{banner}', [BannerController::class, 'update']);

// Delete a banner by ID
Route::delete('/banners/{banner}', [BannerController::class, 'destroy'])->name('banner.delete');

Route::post('/banners/{banner}/toggle-featured', [BannerController::class, 'toggleFeatured'])->name('banner.toggle-featured');

