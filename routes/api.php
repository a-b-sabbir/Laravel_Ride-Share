<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('role', [RoleController::class, 'store']);

