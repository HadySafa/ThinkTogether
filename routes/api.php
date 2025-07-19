<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/check-username', [AuthController::class, 'checkUsername']);

Route::middleware('auth:api')->get('/', function () {
    return response()->json(['message' => 'You are authorized to access this route'], 200);
});

/*
Route::middleware('auth:api')->group(function () {
    
    Route::get('/categories', [CategoryController::class, 'index']);

    Route::post('/posts', [PostController::class, 'store']);

});
*/

Route::get('/categories', [CategoryController::class, 'index']);

Route::post('/posts', [PostController::class, 'store']);
Route::get('/posts', [PostController::class, 'index']);
Route::delete('/posts/{id}', [PostController::class, 'destroy']);

