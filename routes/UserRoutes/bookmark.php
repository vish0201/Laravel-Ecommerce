<?php

use App\Http\Controllers\BookmarkController;
use Illuminate\Support\Facades\Route;

Route::prefix('bookmark')->group(function () {
    Route::post('/add',  [BookmarkController::class , "addToBookmark"] )->name('bookmark.add');
    Route::get('/get', [BookmarkController::class, "getBookmarks"])->name('bookmarks.get');
    Route::delete('/remove', [BookmarkController::class, "removeFromBookmark"])->name('bookmark.remove');



});