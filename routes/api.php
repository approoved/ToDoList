<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

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

Route::middleware('auth:api')
    ->prefix('/categories')
    ->controller(CategoryController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{category}', 'show');
        Route::put('/{category}', 'update');
        Route::delete('/{category}', 'destroy');
});