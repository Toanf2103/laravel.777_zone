<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\AuthController;
use App\Http\Controllers\Site\GoogleController;
use App\Http\Controllers\Site\OrderController;

use App\Http\Controllers\Admin;
use App\Http\Middleware\UserMiddleware;

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


// Route::get('/Test-ac', function () {
//     User::create(['id'=>'nv1','username' => 'nv','password'=>bcrypt('nv'),'role' => 'nv','name' =>'nv']);
// });

//Site
Livewire::setScriptRoute(function ($handle) {
    return Route::get(basename(base_path()) . '/vendor/livewire/livewire/dist/livewire.js', $handle);
});

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(basename(base_path()) . '/livewire/update', $handle);
});


Route::get('/', [HomeController::class, 'home'])->name('site.home');
Route::get('/tim-kiem', [HomeController::class, 'search'])->name('site.search');

Route::get('/cart', [HomeController::class, 'cart'])->name('site.cart');
Route::get('/category/{categorySlug}', [HomeController::class, 'category'])->name('site.category');
Route::get('/category/{categorySlug}/{brandSlug}', [HomeController::class, 'categoryBrand'])->name('site.category.brand');
Route::get('/product/{productSlug}', [HomeController::class, 'product'])->name('site.product');


Route::get('/mua-ngay/{idProduct}', [OrderController::class, 'buyNow'])->name('site.buyNow');
Route::get('/order', [OrderController::class, 'order'])->name('site.order');
Route::get('/orderMenu', [OrderController::class, 'orderMenu'])->middleware('user')->name('site.order.menu');
Route::get('/tra-cuu-don-hang', [OrderController::class, 'searchOrder'])->name('site.search.order');


Route::post('/checkout', [OrderController::class, 'checkout'])->name('site.checkout');


//checkout order
Route::get('/vnpayCheckoutDone', [OrderController::class, 'vnpayCheckoutDone'])->name('site.vnpay.checkoutDone');
Route::get('/momoCheckoutDone', [OrderController::class, 'momoCheckoutDone'])->name('site.vnpay.momoCheckoutDone');
Route::get('/pdfOrder/{orderId}', [OrderController::class, 'pdfOrder'])->name('site.pdfOrder');
Route::get('/showBillOrder/{orderId}', [OrderController::class, 'showBillOrder'])->name('site.showBillOrder');



// Login user
Route::post('/login', [AuthController::class, 'login'])->name('site.auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('site.auth.logout');
Route::post('/register', [AuthController::class, 'register'])->name('site.auth.register');

Route::group(['prefix' => 'profile', 'middleware' => 'user'], function () {

    Route::get('/edit', [AuthController::class, 'editProfile'])->name('site.auth.edit');
    Route::post('/edit', [AuthController::class, 'changeInfo'])->name('site.auth.changeInfo');

    Route::get('/change-pass', [AuthController::class, 'changePassView'])->name('site.auth.pass');
    Route::post('/', [AuthController::class, 'changePass'])->name('site.auth.changePass');

    Route::get('/avatar', [AuthController::class, 'avatar'])->name('site.auth.avatar');
    Route::post('/avatar-change', [AuthController::class, 'changeAvatar'])->name('site.auth.changeAvatar');

});

// Google
Route::get('/google', [GoogleController::class, 'redirectToGoogle'])->name('site.auth.redirectToGoogle');
Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback']);



// Admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [Admin\HomeController::class, 'dashboard'])->name('admin.dashboard');

    // Auth
    Route::get('/login', [Admin\AuthController::class, 'login'])->name('admin.auth.login');
    Route::post('/login', [Admin\AuthController::class, 'handleLogin'])->name('admin.auth.login');
    Route::get('/logout', [Admin\AuthController::class, 'logout'])->name('admin.auth.logout');
    Route::get('/personal', [Admin\AuthController::class, 'personal'])->name('admin.auth.personal');
    Route::put('/personal/update', [Admin\AuthController::class, 'personalUpdate'])->name('admin.auth.personal.update');
    Route::post('/change-password', [Admin\AuthController::class, 'changePassword'])->name('admin.auth.changePassword');

    // Post
    Route::group(['prefix' => 'banners'], function () {
        Route::get('/', [Admin\BannerController::class, 'index'])->name('admin.banners.index');
        Route::get('/create', [Admin\BannerController::class, 'create'])->name('admin.banners.create');
        Route::post('/', [Admin\BannerController::class, 'store'])->name('admin.banners.store');
        Route::get('/{banner}/edit', [Admin\BannerController::class, 'edit'])->name('admin.banners.edit');
        Route::put('/{banner}', [Admin\BannerController::class, 'update'])->name('admin.banners.update');
    });

    // Category
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [Admin\CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/create', [Admin\CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/', [Admin\CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/{category}/edit', [Admin\CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/{category}', [Admin\CategoryController::class, 'update'])->name('admin.categories.update');
    });

    // Brand
    Route::group(['prefix' => 'brands'], function () {
        Route::get('/', [Admin\BrandController::class, 'index'])->name('admin.brands.index');
        Route::get('/create', [Admin\BrandController::class, 'create'])->name('admin.brands.create');
        Route::post('/', [Admin\BrandController::class, 'store'])->name('admin.brands.store');
        Route::get('/{brand}/edit', [Admin\BrandController::class, 'edit'])->name('admin.brands.edit');
        Route::put('/{brand}', [Admin\BrandController::class, 'update'])->name('admin.brands.update');
    });

    // Product
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [Admin\ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/create', [Admin\ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/', [Admin\ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/{product}/edit', [Admin\ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/{product}', [Admin\ProductController::class, 'update'])->name('admin.products.update');
    });

    // Customer
    Route::group(['prefix' => 'customers'], function () {
        Route::get('/', [Admin\CustomerController::class, 'index'])->name('admin.customers.index');
        Route::get('/{customer}/toggle-status', [Admin\CustomerController::class, 'toggleStatus'])->name('admin.customers.toggleStatus');
    });

    // Comment
    Route::group(['prefix' => 'comments'], function () {
        Route::get('/', [Admin\CommentController::class, 'index'])->name('admin.comments.index');
        Route::get('/{comment}/show', [Admin\CommentController::class, 'show'])->name('admin.comments.show');
        Route::get('/{comment}/delete', [Admin\CommentController::class, 'delete'])->name('admin.comments.delete');
        Route::get('/{userId}/delete-all-comment-by-user', [Admin\CommentController::class, 'deleteAllCommentByUser'])->name('admin.comments.deleteAllCommentByUser');
    });

    // Employee
    Route::group(['prefix' => 'employees'], function () {
        Route::get('/', [Admin\EmployeeController::class, 'index'])->name('admin.employees.index');
        Route::get('/create', [Admin\EmployeeController::class, 'create'])->name('admin.employees.create');
        Route::post('/', [Admin\EmployeeController::class, 'store'])->name('admin.employees.store');
        Route::get('/{employee}/toggle-status', [Admin\EmployeeController::class, 'toggleStatus'])->name('admin.employees.toggleStatus');
        Route::get('/{employee}/reset-password', [Admin\EmployeeController::class, 'resetPassword'])->name('admin.employees.resetPassword');
    });

    // Order
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', [Admin\OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/{order}/show', [Admin\OrderController::class, 'show'])->name('admin.orders.show');
        Route::get('/{order}/change-status/{status}', [Admin\OrderController::class, 'changeStatus'])->name('admin.orders.changeStatus');
    });
});
