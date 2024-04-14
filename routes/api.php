<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\Api\StudyController;
use App\Http\Controllers\Api\StudyCategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('posts', PostController::class);
Route::apiResource('tags', TagController::class);
Route::apiResource('studies', StudyController::class);
Route::apiResource('categories', StudyCategoryController::class);
