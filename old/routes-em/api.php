<?php

use App\Http\Controllers\API\ContactListController;
use App\Http\Controllers\API\CurrencyController;
use App\Http\Controllers\API\OfficeController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\DebtsAndReceivableController;
use App\Http\Controllers\API\StatusController;

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
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Auth
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::put('/chnge-possword', [AuthController::class, 'changePassowrd'])->name('changePassowrd');

    // Route::group(['middleware' =>[ 'auth:sanctum','decryptRequest']], function () {
    Route::get('/userDetails', [AuthController::class, 'userDetails'])->name('user');
    Route::get('/offices', [OfficeController::class, 'index'])->name('office.index');
    Route::get('/offices/{id}', [OfficeController::class, 'show'])->name('office.show');
    Route::post('/create-office', [OfficeController::class, 'ApiCreate'])->name('office.create');


    Route::group(['prefix' => 'transaction'], function () {

        // Route::get('/received', [TransactionController::class, 'receivedTransactions']);
        // Route::get('/sent', [TransactionController::class, 'sentTransactions']);
        // Route::get('/delete-request', [TransactionController::class, 'deleteTransactions']);
        // Route::get('/edit-request', [TransactionController::class, 'transactionsConfirmRequests']);
                 Route::get('/office/{id}', [TransactionController::class, 'office']);

        Route::post('transfer-delivery/{id}', [TransactionController::class, 'transferDelivery']);
        Route::put('/confirm-edit/{id}', [TransactionController::class, 'ConfirmUpdate']);
        Route::put('/confirm-received/{id}', [TransactionController::class, 'confirmRecived']);
        Route::delete('/delete/{id}', [TransactionController::class, 'DeleteReq']);
        Route::put('/confirm-delete/{id}', [TransactionController::class, 'confirmDelete']);
    });
    Route::apiResource('transaction', 'App\Http\Controllers\API\TransactionController')->except('destroy');
    Route::apiResource('manual-office', 'App\Http\Controllers\API\ManualOfficeController');

    // currencies
    Route::apiResource('currencies', 'App\Http\Controllers\API\CurrencyController')->except(['show']);
    Route::get('currencies/office', [CurrencyController::class, 'offices'])->name('currencies.offices');
    Route::post('currencies/office', [CurrencyController::class, 'AddCurrncyTooffices'])->name('currencies.TOoffices');


    // debt-and-receivable
    Route::group(['prefix' => 'debt-and-receivable'], function () {
        Route::get('/office', [DebtsAndReceivableController::class, 'index'])->name('debts.index');
        Route::get('/debts', [DebtsAndReceivableController::class, 'debts'])->name('debts.debts');
        Route::get('/receivables', [DebtsAndReceivableController::class, 'receivables'])->name('debts.receivables');
        Route::post('/store', [DebtsAndReceivableController::class, 'store'])->name('debts.store');
        Route::put('/update/{id}', [DebtsAndReceivableController::class, 'update'])->name('debts.update');
        Route::delete('/delete/{id}', [DebtsAndReceivableController::class, 'destroy'])->name('debts.delete');
        Route::get('/{id}', [DebtsAndReceivableController::class, 'show'])->name('debts.show');
    });

    // contact-lists
    Route::group(['prefix' => 'contact-list'], function () {
        Route::get('/', [ContactListController::class, 'index'])->name('contact.index');
        Route::post('/', [ContactListController::class, 'store'])->name('contact.store');
        Route::put('/{id}', [ContactListController::class, 'update'])->name('contact.update');
        Route::delete('/{id}', [ContactListController::class, 'destroy'])->name('contact.delete');
    });

    // status
    Route::group(['prefix' => 'status'], function () {
        Route::get('/', [StatusController::class, 'index'])->name('status.index');
        Route::get('/{id}', [StatusController::class, 'show'])->name('status.show');
        Route::post('/', [StatusController::class, 'store'])->name('status.store');
        Route::put('/{id}', [StatusController::class, 'update'])->name('status.update');
        Route::delete('/{id}', [StatusController::class, 'destroy'])->name('status.delete');
    });
});
