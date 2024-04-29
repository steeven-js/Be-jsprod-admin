<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\StudyController;
use App\Http\Controllers\Api\CustomerController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('posts', PostController::class);
Route::apiResource('tags', TagController::class);
Route::apiResource('studies', StudyController::class);
Route::apiResource('customers', CustomerController::class);
