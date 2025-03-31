<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PusherAuthController;
use App\Http\Controllers\PusherController;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);




// Protected Routes (Require Authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/messages', [MessageController::class, 'sendMessage']);
    Route::patch('/messages/{id}/complete', [MessageController::class, 'completeMessage']);
    Route::post('/pusher/auth', [PusherController::class, 'authenticate']);
});

