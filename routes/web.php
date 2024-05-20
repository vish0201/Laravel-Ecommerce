<?php

use App\Models\Banner;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('/',   function () {

    $category  =  ProductCategory::where('featured', true)->get();
    $product = Product::all();
    $user = User::all();
    $banners = Banner::where('featured', true)->get();


    return view('UserComponents.index', compact('category', 'product', 'user', 'banners'));
})->name('user.index');


Route::get('/admin',   function () {

    $category  =  ProductCategory::all();
    $product = Product::all();
    $user = User::all();

    return view('AdminComponents.dashboard.index', compact('category', 'product', 'user'));
})->name('index');


require __DIR__ . '/AdminRoutes/products.php';
require __DIR__ . '/AdminRoutes/categories.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/AdminRoutes/users.php';
require __DIR__ . '/AdminRoutes/banners.php';



// User routes
require __DIR__ . '/UserRoutes/common/loginSignup.php';
require __DIR__ . '/UserRoutes/cart.php';
require __DIR__ . '/UserRoutes/bookmark.php';
