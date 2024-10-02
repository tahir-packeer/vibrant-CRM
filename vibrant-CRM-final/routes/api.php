<?php

use App\Http\Controllers\Api\CategoryMobileController;
use App\Http\Controllers\Api\CustomizationMobileController;
use App\Http\Controllers\Api\DelivererMobileController;
use App\Http\Controllers\Api\OrderMobileController;
use App\Http\Controllers\Api\ProductMobileController;
use App\Http\Controllers\Api\UserMobileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route to register
Route::post('/register',[Controller::class, 'register']);

//route to log in
Route::post('/login',[Controller::class, 'login']);

                            // Category API
Route::get('/categories', [CategoryMobileController::class, 'index']);

                        //get category by id
Route::get('/categories/{id}', [CategoryMobileController::class, 'show']);

                            //Product API
Route::get('/products', [ProductMobileController::class, 'index']);
Route::get('/products/{id}', [ProductMobileController::class, 'show']);

                            // User routes
Route::get('/user/{id}', [UserMobileController::class, 'show']);
Route::put('/users/update/{id}', [UserMobileController::class, 'update']);

                            // Order routes
Route::post('/orders', [OrderMobileController::class, 'store']);
Route::post('/orders/bulk/cart', [OrderMobileController::class, 'Cartstore']);
Route::get('/orders/byuser/{id}', [OrderMobileController::class, 'getByUserId']);
Route::delete('/orders/customer/{id}', [OrderMobileController::class, 'removeByCustomer']);

                           //Deliverer routes
Route::get('/deliverers/order/{order_id}', [DelivererMobileController::class, 'getOrderDeliverer']);

                           // Customization routes
Route::post('/customizations', [CustomizationMobileController::class, 'store']);
Route::get('/customizations/{user_id}', [CustomizationMobileController::class, 'getUserCustomizations']);

Route::get('/customizations/{user_id}/pending-payment', [CustomizationMobileController::class, 'getPendingPaymentCustomizations']);
Route::put('/customizations/{id}/confirm-payment', [CustomizationMobileController::class, 'confirmPayment']);

                              // Cart routes
Route::post('/add-to-cart', [CartController::class, 'addToCart']);
Route::get('cart/user/{id}', [CartController::class, 'getCartByUserId']);
Route::delete('cart/item/{cart_id}', [CartController::class, 'deleteCartItem']);
Route::put('cart/item/{cart_id}', [CartController::class, 'updateProductQuantity']);


