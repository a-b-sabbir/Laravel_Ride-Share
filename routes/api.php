<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('role', [RoleController::class, 'store']);


use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Pilot\PaymentController as PilotPaymentController;

Route::post('/process-payment', [PilotPaymentController::class, 'processPayment']);
