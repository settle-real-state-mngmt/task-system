<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

$authMiddlewares = ['middleware' => 'api', 'prefix' => 'auth'];

Route::post('/register', [UserController::class, 'register'])->middleware('api');

Route::group($authMiddlewares, function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});
