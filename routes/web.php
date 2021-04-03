<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DisbursementController as Api;
use App\Http\Controllers\DisbursementController ;

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

Route::get('/', [DisbursementController::class, 'index'])->name('disbursement');

Route::group(['prefix' => 'v1'], function() {
    Route::post('/disburse', [Api::class, 'store'])->name('disbursement.store');

    Route::get('/disburse/{id}', [Api::class, 'show'])->name('disbursement.get');
});
