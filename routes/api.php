<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;


/**
 * Routes that are NOT protected by JWT token
 */
Route::post('/users', [UserController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);

/**
 * Routes that are protected by JWT token
 * using auth:api middleware
 */
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/teams', [TeamController::class, 'store']);
    Route::post('/teams/{team}/users', [TeamController::class, 'attachUserToTeam']);

    Route::get('/buildings/{id}/tasks', [BuildingController::class, 'index']);
    Route::post('/buildings', [BuildingController::class, 'store']);
    Route::post('/buildings/{id}/tasks', [BuildingController::class, 'storeTask']);

    Route::post('/tasks/{task}/comments', [TaskController::class, 'storeComments']);
});
