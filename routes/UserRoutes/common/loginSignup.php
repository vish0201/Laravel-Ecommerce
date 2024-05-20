<?php

use App\Http\Controllers\UserAuthController;
use Illuminate\Support\Facades\Route;



Route::get('/login-register', [UserAuthController::class, 'showLoginForm'])->name('user-login-signup');
Route::post('/user/login', [UserAuthController::class, 'login'])->name('login.submit');
Route::post('/register', [UserAuthController::class, 'register'])->name('register.submit');
Route::get('/profile' , [UserAuthController::class, 'userProfile'])->name('user.profile');
Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout');
Route::post('/update-image', [UserAuthController::class, 'updateImage'])->name('update.image');
Route::post('/update-user', [UserAuthController::class, 'updateUser'])->name('update.user');


