<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
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
Route::get('/back/{page_name}', [ShopController::class, 'back']);
Route::get('/', [ShopController::class, 'show'])->name('show');
Route::get('/search', [ShopController::class, 'search'])->name('search');

Route::middleware('auth', 'verified')->group(function () {
    Route::post('/reserve', [ReservationController::class, 'reserve']);
    Route::get('/mypage', [ShopController::class, 'showMypage'])->name('mypage');
    Route::get('/favorite/{shop_id}', [ShopController::class, 'toggleFavorite'])->name('toggleFavorite');
    Route::get('/detail/{id}/{page_name}', [ShopController::class, 'showDetail'])->name('showDetail');
    Route::get('/delete/{id}', [ShopController::class, 'delete'])->name('delete');
    Route::get('/edit/{id}',[ReservationController::class,('edit')])->name('edit');
    Route::post('/update',[ReservationController::class,'update'])->name('update');
    Route::get('/rating/{id}',[ReservationController::class,'rating']);
    Route::post('/rating_upload',[ReservationController::class,'setRating']);
    Route::get('/checkout', [ReservationController::class, 'checkout'])->name('checkout');
    Route::get('/showqr/{id}',[ReservationController::class,'showQr'])->name('showqr');
    Route::get('/checkout_success', [ReservationController::class, 'success'])->name('success');
    Route::get('/checkout_cancel', [ReservationController::class, 'cancel'])->name('cancel');

    Route::prefix('/admin')->group(function(){
        Route::get('/', [AdminController::class, 'showAdmin'])->name('showAdmin');
        Route::post('/set_shop_manager', [AdminController::class, 'setShopManager']);
        Route::post('/delete_shop_manager', [AdminController::class, 'deleteShopManager']);
        Route::get('/shopedit', [AdminController::class, 'shopEdit']);
        Route::get('/reservelist', [AdminController::class, 'reserveList']);
        Route::post('/shopupdate', [AdminController::class, 'shopUpdate']);
        Route::get('/create-shop', [AdminController::class, 'showCreatePage']);
        Route::post('/create', [AdminController::class, 'shopCreate']);
        Route::get('/mailform',[AdminController::class,'showMailForm']);
        Route::post('/sendmail', [AdminController::class, 'sendMail']);
    });
});

require __DIR__ . '/auth.php';
