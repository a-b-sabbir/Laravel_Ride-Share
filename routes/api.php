<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('role', [RoleController::class, 'store']);

// For logged-in users, you can protect routes with middleware (optional)
Route::group(['middleware' => 'auth:sanctum'], function () {
    // Protected routes (accessible only with an authenticated API token)
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
