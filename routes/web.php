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

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/products', function () {
    return view('products');
})->name('products');

Route::get('/users', function () {
    return view('users');
})->middleware(['auth'])->name('users');

Route::get('/orders', function () {
    return view('orders');
})->middleware(['auth'])->name('orders');

Route::get('/basket', function () {
    return view('basket');
})->middleware(['auth'])->name('basket');

Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth'])->name('profile');

require __DIR__.'/auth.php';
