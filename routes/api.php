<?php

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
