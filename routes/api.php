<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\TaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('auth/register', 'register');
        Route::post('auth/login', 'login');
    });

    Route::middleware('auth:sanctum')->group(function () {
        // Route::get('auth/me', 'me');
        Route::apiResource('tasks', TaskController::class);
        Route::post('auth/logout', [AuthController::class, 'logout']);
    });
});

