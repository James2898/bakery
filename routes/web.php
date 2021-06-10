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

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/products', function () {
    return view('products');
})->name('products');

// Route::get('/users', [UserController::class, 'index'])
//     ->middleware('auth')
//     ->name('users');

// Route::get('/users/create', [UserController::class, 'create'])
//     ->middleware('auth')
//     ->name('users.create');

// Route::post('/users/create', [UserController::class, 'add'])
//     ->middleware('auth');


Route::group(['middleware' => 'auth'], function(){
        Route::get('/users',[UserController::class, 'index'])->name('users');
        Route::get('/users/add',[UserController::class, 'create'])->name('users.create');
        Route::get('/users/edit/{id}',[UserController::class, 'edit'])->name('users.edit');
        Route::post('/users/add',[UserController::class, 'store'])->name('users.store');
        Route::put('/users/edit',[UserController::class, 'update'])->name('users.update');
        Route::get('/users/{id}',[UserController::class, 'delete'])->name('users.delete');
        Route::get('/profile/{id}',[UserController::class, 'profile'])->name('profile');
        Route::put('/profile',[UserController::class, 'profile_update'])->name('profile.update');
});

Route::get('/orders', function () {
    return view('orders');
})->middleware(['auth'])->name('orders');

Route::get('/basket', function () {
    return view('basket');
})->middleware(['auth'])->name('basket');

Route::get('/about', function () {
    return view('about');
})->name('about');

require __DIR__.'/auth.php';
