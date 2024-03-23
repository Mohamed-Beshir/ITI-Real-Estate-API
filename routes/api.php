<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\api\ImageController;
use App\Http\Controllers\RentOfferController;

use App\Http\Controllers\SaleOfferController;

use App\Http\Controllers\api\ReviewController;
use App\Http\Controllers\api\PropertyController;
use App\Http\Controllers\api\auth\AuthController;
use App\Http\Controllers\api\Rent_offerController;


use App\Http\Controllers\api\Sale_offerController;
use App\Http\Controllers\api\PropertyRentController;
use App\Http\Controllers\api\PropertySaleController;
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


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::apiResource('property_rents', PropertyRentController::class);
Route::apiResource('property_sales', PropertySaleController::class);

Route::apiResource("properties",PropertyController::class);
Route::get("properties-agent",[PropertyController::class, 'properties_agent']);
Route::get('properties-search', [PropertyController::class, 'search']);
Route::get('properties-rent-or-sale', [PropertyController::class, 'index_rent_or_sale']);
Route::get("reviews-comments", [ReviewController::class, 'index_comments']);
Route::get("reviews-rates", [ReviewController::class, 'index_rates']);
Route::apiResource("reviews", ReviewController::class);
Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('users', UserController::class);

    Route::apiResource('/offers', Rent_offerController::class);
    
    Route::apiResource('/payments', Rent_paymentController::class);
    Route::apiResource('/sale_payments', Sale_paymentController::class);


});

Route::apiResource('images', ImageController::class);

Route::apiResource('/rent_offers', Rent_offerController::class);
Route::apiResource('/sale_offers', Sale_offerController::class);
//
Route::put('saleoffers/accept/{id}', [SaleOfferController::class, 'acceptOffer']);
Route::put('saleoffers/reject/{id}', [SaleOfferController::class, 'rejectOffer']);
//
Route::put('rentoffers/accept/{id}', [RentOfferController::class, 'acceptOffer']);
Route::put('rentoffers/reject/{id}', [RentOfferController::class, 'rejectOffer']);

Route::apiResource('users',UserController::class);
