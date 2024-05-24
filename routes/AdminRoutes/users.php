<?php

use App\Http\Controllers\UsersController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::get('/users', [UsersController::class, "usersPage"])->name('users');

    Route::get('/get-user-data', function() {
        $users = User::all(); // Fetch all users
        $userData = $users->pluck('username', 'id')->toArray(); // Example: Pluck user names with IDs
    
        return response()->json($userData);
    });
    
});
