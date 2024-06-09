<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Api\StudyController;
use App\Http\Controllers\api\StripeController;
use App\Http\Controllers\api\productController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ContactMailController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('posts', PostController::class);
Route::apiResource('tags', TagController::class);
Route::apiResource('studies', StudyController::class);
Route::apiResource('customers', CustomerController::class);
Route::apiResource('contacts', ContactMailController::class);
Route::apiResource('products', productController::class);
Route::apiResource('carts', CartController::class);
Route::apiResource('stripe', StripeController::class);
Route::apiResource('services', ServiceController::class);
