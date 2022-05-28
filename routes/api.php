<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
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

    Route::prefix('/categories')
        ->controller(CategoryController::class)
        ->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{category}', 'show');
            Route::put('/{category}', 'update');
            Route::delete('/{category}', 'destroy');
    });

    Route::prefix('/categories/{category}/tasks')
        ->controller(TaskController::class)
        ->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{task}', 'show');
            Route::put('/{task}', 'update');
            Route::delete('/{task}', 'destroy');
    });

    Route::controller(TagController::class)->group(function () {
            Route::get('/tags', 'index');
            Route::post('/tasks/{task}/tags', 'attach');
            Route::delete('/tasks/{task}/tags/{tag}', 'detach');
    });  
});
