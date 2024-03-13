<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\auth\AuthController;

use App\Http\Controllers\api\PropertyRentController;
use App\Http\Controllers\api\PropertySaleController;
use App\Http\Controllers\UserController;


use App\Http\Controllers\api\ReviewController;



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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('property_rents', PropertyRentController::class);
    Route::apiResource('property_sales', PropertySaleController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource("reviews", ReviewController::class);

});







