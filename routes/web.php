<?php

use Illuminate\Support\Facades\Auth;
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
    return redirect('/index');
});

Auth::routes();

Route::get('/index',[App\Http\Controllers\Frontend\FrontendController::class, 'index']);
Route::get('/product/{slug}',[App\Http\Controllers\Frontend\FrontendController::class, 'detailProduct']);
Route::get('/shop',[App\Http\Controllers\Frontend\FrontendController::class, 'shop']);
Route::get('/orders',[App\Http\Controllers\Frontend\FrontendController::class,'orders'])->middleware('auth');
Route::post('/cancel-order/{orderId}',[App\Http\Controllers\Frontend\FrontendController::class,'cancelOrder'])->middleware('auth');
Route::get('/detail-order/{id}',[App\Http\Controllers\Frontend\FrontendController::class,'detailOrder'])->middleware('auth');
Route::get('/wishlist',[App\Http\Controllers\Frontend\WishlistController::class, 'index'])->name('wishlist')->middleware('auth');
Route::get('/cart',[App\Http\Controllers\Frontend\FrontendController::class, 'cart'])->middleware('auth')->middleware('checkCart');
Route::get('/checkout',[App\Http\Controllers\Frontend\FrontendController::class, 'checkout'])->middleware('auth')->middleware('checkCart');
Route::get('/thank-you',[App\Http\Controllers\Frontend\FrontendController::class, 'thankyou']);
Route::get('/empty-cart',[App\Http\Controllers\Frontend\FrontendController::class, 'emptyCart']);
Route::get('/{slug}',[App\Http\Controllers\Frontend\FrontendController::class,'productsFromCategory']);

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index']);

    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{id}/edit', 'edit');
        Route::put('/category/{id}', 'update');
        Route::get('/category/{id}/delete', 'destroy');


    });
    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
        Route::get('/product', 'index');
        Route::get('/product/create', 'create');
        Route::post('/product/store', 'store');
        Route::get('/product/{id}/edit', 'edit');
        Route::put('/product/{id}', 'update');
        Route::get('/product/{id}/delete', 'destroy');
        Route::get('/product-image/{id}/delete','destroyImage');
        Route::get('/product-color/{prod_color_id}/delete','deleteProdColor');
        Route::post('/product-color/{prod_color_id}','updateProdColorQty');
    });

    Route::controller(App\Http\Controllers\Admin\ColorController::class)->group(function () {
        Route::get('/color', 'index');
        Route::get('/color/create', 'create');
        Route::post('/color/store', 'store');
        Route::get('/color/{id}/edit', 'edit');
        Route::put('/color/{id}', 'update');
        Route::get('/color/{id}/delete', 'destroy');
    });

    Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function () {
        Route::get('/slider', 'index');
        Route::get('/slider/create', 'create');
        Route::post('/slider/store', 'store');
        Route::get('/slider/{id}/edit', 'edit');
        Route::put('/slider/{id}', 'update');
        Route::get('/slider/{id}/delete', 'destroy');
    });

    Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::get('/detail-order/{orderId}','view');
        Route::post('/update-status-order/{orderId}','update');
    });
    Route::controller(App\Http\Controllers\Admin\DiscountController::class)->group(function () {
        Route::get('/discounts', 'index');
        Route::get('/discounts/create','create');
        Route::post('/discounts/store','store');
        Route::get('/sendCode/{discountId}','sendCode');
        Route::post('/sendCode/{discountId}','postSendCode');
        Route::get('/sendCodeAllUsers/{discountId}','sendCodeAllUsers');
        Route::get('/discounts/delete/{id}','destroy');
        Route::get('/discounts/edit/{id}','edit');
        Route::put('/discounts/update/{id}','update');
    });
});
