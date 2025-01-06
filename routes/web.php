<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Pilot\LicenseController;
use App\Http\Controllers\Pilot\PilotController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Default Route
Route::get('/', function () {
    return view('welcome');
});

// -------------------------------------------
// Authentication Routes
// -------------------------------------------
Route::view('/chooseregistration', 'auth.chooseregistration');
Route::view('/passenger-registration', 'auth.registration');
Route::view('/login', 'auth.login');
Route::view('/forgot', 'auth.forgot');

Route::post('/register_post', [AuthController::class, 'register_post']);
Route::post('/login_post', [AuthController::class, 'login_post']);
Route::post('/forgot', [AuthController::class, 'forgot']);
Route::get('logout', [AuthController::class, 'logout']);

// -------------------------------------------
// Pilot Routes
// -------------------------------------------

Route::view('/pilot-registration', 'pilot.pilot_registration');
Route::post('/pilot/register', [PilotController::class, 'store'])->name('pilot_register');
Route::view('/pilot/license', 'pilot.pilot_license')->name('pilot_license');
Route::post('/upload-license', [LicenseController::class, 'uploadLicense'])->name('license.upload');
Route::post('pilot/license', [LicenseController::class, 'store'])->name('pilot_license');
Route::view('/pilot/success', 'pilot.success')->name('pilot.success');
Route::view('/pilot/fail', 'pilot.fail')->name('pilot.fail');


// -------------------------------------------
// Profile Management Routes
// -------------------------------------------
Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
Route::get('/profile', [ProfileController::class, 'index']);

// -------------------------------------------
// Dashboard Routes (Role-Based Access)
// -------------------------------------------
Route::group(['middleware' => 'super_admin'], function () {
    Route::get('super_admin/dashboard', [DashboardController::class, 'dashboard']);
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
});

Route::group(['middleware' => 'sub_admin'], function () {
    Route::get('sub_admin/dashboard', [DashboardController::class, 'dashboard']);
});

Route::group(['middleware' => 'pilot'], function () {
    Route::get('pilot/dashboard', [DashboardController::class, 'dashboard']);
});
