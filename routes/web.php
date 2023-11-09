<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController as HomeController;
use App\Http\Controllers\Site\AuthController as AuthController;

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;


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

Route::get('/', [HomeController::class, 'home'])->name('site.home');
Route::get('/catelory', [HomeController::class, 'catelory'])->name('site.catelory');
Route::get('/product', [HomeController::class, 'product'])->name('site.product');
Route::get('/cart', [HomeController::class, 'cart'])->name('site.cart');


//login user
Route::post('/login', [AuthController::class, 'login'])->name('site.auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('site.auth.logout');
Route::post('/register', [AuthController::class, 'register'])->name('site.auth.register');


//admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [AdminHomeController::class, 'home'])->name('admin.home');
});


