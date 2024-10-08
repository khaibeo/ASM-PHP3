<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Api\CatalogueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Api\VoucherController as ApiVoucherController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('vouchers', ApiVoucherController::class);

Route::delete('/catalogue/{id}',[CatalogueController::class,'destroy']);

Route::post('/vouchers/import', [VoucherController::class, 'import'])->name('import-vouchers');

Route::get('/orders/export', [OrderController::class, 'export'])->name('export-orders');


