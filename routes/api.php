<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;



// anyone is allowed to access the following routes:
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/check-username', [AuthController::class, 'checkUsername']);


// only authenticated users are allowed to access the following routes: 
Route::middleware('auth:api')->group(function () {

    // users
    Route::get('/users/{id}', [UserController::class, 'userById']);
    Route::put('/users', [UserController::class, 'update']);
    Route::post('/update-password', [AuthController::class, 'changePassword']);


    // categories
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);

    // tags
    Route::post('/posts/{id}/tags', [TagController::class, 'store']);
    Route::get('/posts/{id}/tags', [TagController::class, 'index']);

    // reactions 
    Route::get('/posts/{id}/reactions', [ReactionController::class, 'index']);
    Route::post('/posts/{id}/reactions', [ReactionController::class, 'store']);

    // comments
    Route::get('/posts/{id}/comments', [CommentController::class, 'index']);
    Route::post('/posts/{id}/comments', [CommentController::class, 'store']);

    // posts
    Route::post('/posts', [PostController::class, 'store']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/users/{id}/posts', [PostController::class, 'postsByUser']);
    Route::get('/category/{id}/posts', [PostController::class, 'postsByCategory']);
    Route::get('/posts/top', [PostController::class, 'topPosts']);

});

