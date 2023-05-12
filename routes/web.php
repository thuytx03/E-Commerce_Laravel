<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Client\AuthClientController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeClientController;
use App\Http\Controllers\Client\OrderClientController;
use App\Http\Controllers\Client\ProductDetailController;
use App\Models\Cart;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('admin/login', [AuthController::class, 'index']);
Route::post('admin/saveLogin', [AuthController::class, 'login'])->name('saveLogin');

Route::middleware('CheckAdmin')->group(function () {
    Route::prefix('/admin/')->group(function () {
        Route::get('home', function () {
            return view('admin.home', [
                'title' => "Trang quản trị"
            ]);
        });

        // Trang category
        Route::prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('list.category');
            Route::get('/create', [CategoryController::class, 'create'])->name('create.category');
            Route::post('/store', [CategoryController::class, 'store'])->name('store.category');
            Route::delete('/destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy.category');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit.category');
            Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update.category');
        });
        Route::prefix('product')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('list.product');
            Route::get('/create', [ProductController::class, 'create'])->name('create.product');
            Route::post('/store', [ProductController::class, 'store'])->name('store.product');
            Route::delete('/destroy/{id}', [ProductController::class, 'destroy'])->name('destroy.product');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit.product');
            Route::put('/update/{id}', [ProductController::class, 'update'])->name('update.product');
            Route::get('/show/{id}', [ProductController::class, 'show'])->name('show.product');
        });
        Route::prefix('order')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('list.order');

            Route::get('/{id}/detail', [OrderController::class, 'detail'])->name('order.detail');
            Route::get('/{id}/confirm', [OrderController::class, 'confirm'])->name('order.confirm');
            Route::get('/{id}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');
        });
    });
});
Route::get('/login', [AuthClientController::class, 'index'])->name('login');
Route::get('/logout', [AuthClientController::class, 'logout'])->name('logout');
Route::post('/saveLogin', [AuthClientController::class, 'saveLogin'])->name('saveLogin');
Route::get('/register', [AuthClientController::class, 'register'])->name('register');
Route::post('/saveRegister', [AuthClientController::class, 'saveRegister'])->name('saveRegister');

Route::get('/san-pham-chi-tiet/{slug}', [ProductDetailController::class, 'detail'])->name('san-pham-chi-tiet');
Route::middleware('auth')->group(function () {
    Route::get('/', [HomeClientController::class, 'index'])->name('/');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/{id}', [CartController::class, 'deleteCart'])->name('deleteCart');

    // Route::post('/checkout',[OrderClientController::class,'checkout'])->name('checkout');
    Route::get('/order/show', [OrderClientController::class, 'show'])->name('show.order');
    Route::get('/{id}/confirm', [OrderClientController::class, 'confirm'])->name('order.confirm');
    Route::get('/{id}/cancel', [OrderClientController::class, 'cancel'])->name('order.cancel');
    Route::get('/checkout', [OrderClientController::class, 'checkout'])->name('checkout');
    Route::post('/place-order', [OrderClientController::class, 'placeOrder'])->name('place-order');
});
