<?php

use App\Http\Controllers\ProfileController;
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
// Route::get('/', function () {
//     return view('index');
// })->middleware(['auth', 'verified']);

// Route::get('/', function () {
//     return view('index');
// })->middleware(['auth']);
Route::get('/back/{page_name}', [ShopController::class, 'back']);
Route::get('/', [ShopController::class, 'show'])->name('show');
Route::get('/search', [ShopController::class, 'search'])->name('search');
Route::get('/testpage',[ShopController::class,'s3downtest']);

Route::middleware('auth', 'verified')->group(function () {
    Route::post('/reserve', [ReservationController::class, 'reserve']);
    Route::get('/mypage', [ShopController::class, 'showMypage'])->name('showMypage');
    Route::get('/favorite/{shop_id}', [ShopController::class, 'toggleFavorite'])->name('toggleFavorite');
    Route::get('/detail/{id}/{page_name}', [ShopController::class, 'showDetail'])->name('showDetail');
    Route::get('/delete/{id}', [ShopController::class, 'delete'])->name('delete');
    Route::get('/edit/{id}',[ReservationController::class,('edit')])->name('edit');
    Route::post('/update',[ReservationController::class,'update'])->name('update');
});

require __DIR__ . '/auth.php';
