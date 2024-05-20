<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::get('/users', [UsersController::class, "usersPage"])->name('users');
    
});
