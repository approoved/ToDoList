<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::post('/users', [UserController::class, 'store'])
    ->name('users.store');
    
Route::post('/login', [AuthController::class, 'login'])
    ->name('login');
Route::post('/users/{token}', [AuthController::class, 'verify'])
    ->name('email.verify');

Route::middleware('auth:api')->group(function () {
    Route::delete('/users', [AuthController::class, 'logout'])
        ->name('logout');
});
