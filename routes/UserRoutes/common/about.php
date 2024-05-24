<?php

use Illuminate\Support\Facades\Route;

Route::get('/about-us' ,  function () {
return view('UserComponents.pages.about');
})->name('about');