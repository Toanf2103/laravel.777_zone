<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController as HomeController;
use App\Http\Controllers\Site\AuthController as AuthController;

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use Livewire\Livewire;



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

Livewire::setScriptRoute(function ($handle) {
    return Route::get(basename(base_path()).'/vendor/livewire/livewire/dist/livewire.js', $handle);
});

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(basename(base_path()).'/livewire/update', $handle);
});


Route::get('/', [HomeController::class, 'home'])->name('site.home');
Route::get('/tim-kiem', [HomeController::class, 'search'])->name('site.search');

Route::get('/cart', [HomeController::class, 'cart'])->name('site.cart');
Route::get('/category/{categorySlug}', [HomeController::class, 'category'])->name('site.category');
Route::get('/category/{categorySlug}/{brandSlug}', [HomeController::class, 'categoryBrand'])->name('site.category.brand');

Route::get('/product/{productSlug}', [HomeController::class, 'product'])->name('site.product');


//login user
Route::post('/login', [AuthController::class, 'login'])->name('site.auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('site.auth.logout');
Route::post('/register', [AuthController::class, 'register'])->name('site.auth.register');


//admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [AdminHomeController::class, 'home'])->name('admin.home');
});


