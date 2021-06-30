<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::group(['middleware' => 'auth'], function(){
    // Users
    Route::get('/users',[UserController::class, 'index'])->name('users');
    Route::get('/users/add',[UserController::class, 'create'])->name('users.create');
    Route::post('/users/add',[UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}',[UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/edit',[UserController::class, 'update'])->name('users.update');
    Route::get('/users/{id}',[UserController::class, 'delete'])->name('users.delete');
    
    // Profile
    Route::get('/profile',[UserController::class, 'profile'])->name('profile');
    Route::put('/profile',[UserController::class, 'profile_update'])->name('profile.update');

    // Products
    Route::get('/products/add',[ProductController::class, 'create'])->name('products.create');
    Route::post('/products/add',[ProductController::class, 'store'])->name('products.store');
    Route::get('/products/edit/{id}',[ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/edit',[ProductController::class, 'update'])->name('products.update');
    Route::get('/products/{id}',[ProductController::class, 'delete'])->name('products.delete');

    // Basket
    Route::get('/basket', [BasketController::class, 'index'])->name('basket');
    Route::post('/basket',[BasketController::class, 'store'])->name('basket.store');
    Route::get('/basket/checkout', [BasketController::class, 'checkout'])->name('basket.checkout');
    Route::get('/basket/up/{id}',[BasketController::class, 'up'])->name('basket.up');
    Route::get('/basket/down/{id}',[BasketController::class, 'down'])->name('basket.down');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/add', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders/add',[OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/cancel/{id}',[OrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('/orders/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::get('/orders/view/{id}', [OrderController::class, 'view'])->name('orders.view');
    Route::post('/orders/update',[OrderController::class, 'update'])->name('orders.update');

});

Route::get('/products',[ProductController::class, 'index'])->name('products');
Route::get('/products/view/{id}',[ProductController::class, 'view'])->name('products.view');


Route::get('/about', function () {
    return view('about');
})->name('about');

require __DIR__.'/auth.php';
