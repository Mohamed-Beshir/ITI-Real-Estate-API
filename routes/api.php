<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\Rent_offerController;
use App\Http\Controllers\api\Sale_offerController;
use App\Http\Controllers\api\Rent_paymentController;
use App\Http\Controllers\api\Sale_paymentController;

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


Route::apiResource('/offers', Rent_offerController::class);
Route::apiResource('/sale_offers', Sale_offerController::class);

Route::apiResource('/payments', Rent_paymentController::class);
Route::apiResource('/sale_payments', Sale_paymentController::class);