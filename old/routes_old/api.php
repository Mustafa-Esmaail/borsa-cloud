<?php

use App\Http\Controllers\API\OfficeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\API\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::get('/userDetails', [AuthController::class, 'userDetails'])->name('user');
     Route::post('/create-office', [OfficeController::class, 'ApiCreate'])->name('office.create');
    // Route::group(['prefix' => 'transaction'], function () {
    //     Route::get('/office/{office_id}', [TransactionController::class, 'index'])->name('transaction.index');
    //     Route::post('/store', [TransactionController::class, 'store'])->name('transaction.store');
    //     Route::put('/edit/{id}', [TransactionController::class, 'editTransaction'])->name('transaction.edit');
    //     Route::post('/update', [TransactionController::class, 'update'])->name('transaction.update');
    //     Route::get('/delete', [TransactionController::class, 'delete'])->name('transaction.delete');
    //     Route::get('/{id}', [TransactionController::class, 'show'])->name('transaction.show');


    // });
    Route::get('transaction-requests', [TransactionController::class, 'transactionsRequests']);

    Route::apiResource('transaction', 'App\Http\Controllers\API\TransactionController');
    Route::apiResource('manual-office', 'App\Http\Controllers\API\ManualOfficeController');
    Route::get('transaction/confirm-edit/{id}', [TransactionController::class, 'ConfirmUpdate']);



});
