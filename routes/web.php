<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/product', ProductController::class) ->middleware(['auth', 'verified']);
Route::resource('/order', OrderController::class) ->middleware(['auth', 'verified']);
Route::get('/daftarinvoice', [OrderController::class, 'index'])->name('daftarinvoice');
Route::get('/orderproduk', [OrderController::class, 'orderproduk'])->name('orderproduk');
Route::get('/invoice/{id}', [OrderController::class, 'invoice'])->name('invoice');
Route::get('/editinvoice/{id}', [OrderController::class, 'editinvoice'])->name('editinvoice');
Route::post('/updateorder/{id}', [OrderController::class, 'updateorder'])->name('updateorder');

require __DIR__.'/auth.php';
