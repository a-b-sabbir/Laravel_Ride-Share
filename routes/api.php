<?php

use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\PassengerController;
use App\Http\Controllers\Api\LostItemController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

// Public routes for authentication (register, login, logout)
Route::post('register', [AuthController::class, 'register']);      // User registration
Route::post('login', [AuthController::class, 'login']);            // User login
Route::post('logout', [AuthController::class, 'logout']);          // User logout (use middleware for authentication)

// Grouped routes for authenticated users
Route::middleware('auth:api')->group(function () {});
