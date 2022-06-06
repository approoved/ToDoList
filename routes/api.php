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

    Route::controller(TaskController::class)
        ->group(function () {
            Route::get('/categories/{category}/tasks/', 'index');
            Route::post('/categories/{category}/tasks/', 'store');
            Route::get('/categories/{category}/tasks/{task}', 'show');
            Route::put('/categories/{category}/tasks/{task}', 'update');
            Route::delete('/categories/{category}/tasks/{task}', 'destroy');
            Route::post('/tasks/{task}/tags', 'attachTag');
            Route::delete('/tasks/{task}/tags/{tag}', 'detachTag');
    });

    Route::controller(TagController::class)
        ->group(function () {
            Route::get('/tags', 'index');
    });
});
