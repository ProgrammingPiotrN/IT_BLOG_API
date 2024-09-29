<?php

use App\Interfaces\Http\Controllers\Post\PostController;
use App\Interfaces\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::post('/users', [UserController::class, 'store']);
Route::get('/users/profile', [UserController::class, 'show']);
Route::post('/users/logout', [UserController::class, 'logout']);
Route::post('/users/reset-token', [UserController::class, 'resetToken']);

Route::middleware('auth:api')->group(function () {
    Route::post('/posts', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/{postId}/like', [PostController::class, 'like'])->name('posts.like');
    Route::post('/posts/{postId}/comment', [PostController::class, 'comment'])->name('posts.comment');
    Route::delete('/posts/{postId}', [PostController::class, 'delete'])->name('posts.delete');
});

// Trasa do wyświetlania pojedynczego posta nie wymaga uwierzytelnienia
Route::get('/posts/{postId}', [PostController::class, 'show'])->name('posts.show');
