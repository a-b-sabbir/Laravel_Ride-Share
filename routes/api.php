<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('role', [RoleController::class, 'store']);

// API Registration and Login Routes (for mobile apps or external services)
Route::post('/login', [AuthController::class, 'login']);  // Login API
Route::post('/register', [AuthController::class, 'register']);  // Register API
// Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');


// For logged-in users, you can protect routes with middleware (optional)
Route::group(['middleware' => 'auth:sanctum'], function () {
    // Protected routes (accessible only with an authenticated API token)
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
