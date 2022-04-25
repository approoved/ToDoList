<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/users/{token}', [AuthController::class, 'verify'])->name('email.verify');
Route::middleware('auth:api')->delete('/users', [AuthController::class, 'logout'])->name('logout');