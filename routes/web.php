<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImgProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Login Page
Fortify::loginView(function () {
    return view('auth.login');
});

// Register Page
Fortify::registerView(function () {
    return view('auth.register');
});
// Home Page
Route::get('/', function () {
    return view('index');
})->name('index');

// Product Page
Route::get('/shop-now', [ProductController::class, 'index'])->name('products');

// Detail Product Page
Route::get('/shop-now/detail-product/{product}', [ProductController::class, 'show'])->name('detail.product');


Route::group(['middleware' => 'auth'], function() {
    Route::group([
        'prefix'        => 'customer' ,
        'as'            => 'customer.',      
        'middleware'    => 'role:customer',
    ], function(){
        Route::resource('cart', CartController::class)->except(['create', 'edit', 'show']);
        Route::post('chekout', [CartController::class, 'checkout'])->name('checkout');
        Route::post('chekout/address', [CartController::class, 'address'])->name('address');
        
        Route::resource('payment', PaymentController::class)->only(['index', 'store']);
        
        Route::resource('order', OrderController::class)->only(['index', 'update']);

        Route::resource('category', CategoryController::class)->only(['show']);
    });

    Route::group([
        'prefix'        => 'admin' ,
        'as'            => 'admin.',      
        'middleware'    => 'role:admin',
    ], function(){
        Route::get('/dashboard', function () {
            return view('admin.index');
        })->name('index');  
        Route::resource('category', CategoryController::class)->except(['create', 'edit', 'show']);

        Route::resource('product', ProductController::class)->except(['create', 'edit']);    

        Route::resource('imgProduct', ImgProductController::class)->only('destroy',);

        Route::resource('payment', PaymentController::class)->only('index');
        
        Route::resource('order', OrderController::class)->only(['index', 'update']);
    });
});