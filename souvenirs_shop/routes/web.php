<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Services\Menu\MenuService;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\MainController as ControllersMainController;
use App\Http\Controllers\MenuContoller;



#admin
Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::get('/log-out', [LoginController::class, 'logOut'])->name('logout');
Route::post('admin/users/login/store', [LoginController::class, 'store']);

Route::prefix('admin')->middleware(['auth:admin'])->group(function () {

    Route::get('/', [MainController::class, 'index'])->name('admin.index');
    Route::get('/order', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('order.index');
    Route::get('/order/detail/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('order.show');

    
    #Menu
    Route::prefix('menus')->group(function () {
        Route::get('add', [MenuController::class, 'create']);
        Route::post('add', [MenuController::class, 'store']);
        Route::get('list', [MenuController::class, 'index']);
        Route::get('edit/{menu}', [MenuController::class, 'show']);
        Route::post('edit/{menu}', [MenuController::class, 'update']);
        Route::DELETE('destroy', [MenuController::class, 'destroy']);
    });

    #Product
    Route::prefix('products')->group(function() {
        Route::get('add', [ProductController::class, 'create']);
        Route::post('add', [ProductController::class, 'store']);
        Route::get('list', [ProductController::class, 'index']);
        Route::get('edit/{product}', [ProductController::class, 'show']);
        Route::post('edit/{product}', [ProductController::class, 'update']);
        Route::DELETE('destroy', [ProductController::class, 'destroy']);
    });

    #Upload
    Route::post('upload/services', [UploadController::class, 'store']);
});


#customer
Route::get("customer/login", [App\Http\Controllers\AuthController::class, "login"])->name("customer.login");
Route::post("/login", [App\Http\Controllers\AuthController::class, "loginPost"])->name("login.post");
Route::get('customer/logout', [App\Http\Controllers\AuthController::class, 'signOut'])->name('customer.signout');

Route::get("customer/register", [App\Http\Controllers\AuthController::class, "register"])->name("register");
Route::post("/register", [App\Http\Controllers\AuthController::class, "registerPost"])->name("register.post");
Route::middleware(['auth:customer'])->group(function () {
    Route::get('/', [App\Http\Controllers\MainController::class, "index"])->name('home');
});


#cart
Route::post('add-cart', [App\Http\Controllers\CartController::class, 'index']);
Route::get('carts', [App\Http\Controllers\CartController::class, 'show']);
Route::get('/carts/delete/{id}', [App\Http\Controllers\CartController::class, 'remove']);
Route::post('update-cart', [App\Http\Controllers\CartController::class, 'update']);


Route::prefix('order')->middleware(['auth:customer'])->group(function () {
    #order
    Route::get('/checkout', [App\Http\Controllers\OrderController::class, 'checkout'])->name('order.checkout');
    Route::post('/checkout', [App\Http\Controllers\OrderController::class, 'checkoutPost']);
    Route::get('/history', [App\Http\Controllers\OrderController::class, 'history'])->name('order.history');
    Route::get('/detail/{order}', [App\Http\Controllers\OrderController::class, 'detail'])->name('order.detail');

});


#main
Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('home');
Route::post('/services/load-product', [App\Http\Controllers\MainController::class, 'loadProduct']);
Route::get('danh-muc/{id}-{slug}.html', [App\Http\Controllers\MenuController::class, 'index']);
Route::get('san-pham/{id}-{slug}.html', [App\Http\Controllers\ProductController::class, 'index']);


#search
Route::get('/products/search', [App\Http\Controllers\ProductController::class, 'search'])->name('products.search');

