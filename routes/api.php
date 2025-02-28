<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;

Route::post('/users', [UserController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);

/**
 * Routes that are protected by JWT token
 * using auth:api middleware
 */
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);

    Route::post('buildings', [BuildingController::class, 'store']);
    Route::post('/users/staff', [StaffController::class, 'store']);
});
