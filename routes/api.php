<?php

use App\Http\Controllers\Api\CatalogueContrller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VoucherController;

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


Route::delete('/catalogue/{id}',[CatalogueContrller::class,'destroy'])->name('catalogues.destroy');

Route::post('/vouchers/import', [VoucherController::class, 'import'])->name('import-vouchers');

