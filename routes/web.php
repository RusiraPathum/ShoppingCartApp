<?php

use App\Http\Controllers\admin\ProductController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\user\CartController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

//Product routes
Route::resource('products', ProductController::class);

//User routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('user/cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('user/viewCart', [CartController::class, 'viewCart'])->name('users.cart');
Route::put('/user/{cartItem}', [CartController::class, 'updateQuantity'])->name('users.update');
Route::delete('/user/removeCart/{cartItem}', [CartController::class, 'removeFromCart'])->name('users.remove');
Route::post('/cart/empty', [CartController::class, 'emptyCart'])->name('users.empty');
Route::get('/cart/report', [CartController::class, 'report'])->name('users.report');
