<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PusherAuthController;
use App\Http\Controllers\PusherController;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/admin/login', [AdminAuthController::class, 'login']);



// Protected Routes (Require Authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index']);
        Route::post('/admin/messages/{id}/approve', [AdminDashboardController::class, 'approveMessage']);
       
        Route::post('/admin/logout', [AdminAuthController::class, 'logout']);
        Route::get('/admin/user', [AdminAuthController::class, 'adminUser']);
    });

    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/messages', [MessageController::class, 'sendMessage']);
    Route::patch('/messages/{id}/complete', [MessageController::class, 'completeMessage']);
    Route::post('/pusher/auth', [PusherController::class, 'authenticate']);
    Route::post('/messages/{id}/approve', [MessageController::class, 'approveMessage']);
});

