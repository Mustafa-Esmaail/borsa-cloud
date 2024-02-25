<?php

use App\Http\Controllers\OfficeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CurrencyController;
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



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () {
    // Your routes here
    Route::group(['prefix' => 'office'], function () {
        Route::get('/', [OfficeController::class, 'index'])->name('office.index');
        Route::post('/store', [OfficeController::class, 'store'])->name('office.store');
        Route::put('/update/{id}', [OfficeController::class, 'update'])->name('office.update');
        Route::get('/delete/{id}', [OfficeController::class, 'destroy'])->name('office.delete');

    });
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');

    });
    Route::group(['prefix' => 'currencies'], function () {
        Route::get('/', [CurrencyController::class, 'index'])->name('currency.index');
        Route::post('/store', [CurrencyController::class, 'store'])->name('currency.store');
        Route::put('/update/{id}', [CurrencyController::class, 'update'])->name('currency.update');
        Route::get('/delete/{id}', [CurrencyController::class, 'destroy'])->name('currency.delete');

    });
});
