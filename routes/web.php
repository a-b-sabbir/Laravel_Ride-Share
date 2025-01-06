<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PilotController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Registration and Login Pages (for browsers)
Route::view('/chooseregistration', 'auth.chooseregistration');  // Registration page

Route::view('/passenger-registration', 'auth.registration');
Route::view('/pilot-registration', 'pilot.pilot_registration');

Route::post('/register_post', [AuthController::class, 'register_post']);  // Handle registration form

Route::view('/login', 'auth.login');  // Login page
Route::post('/login_post', [AuthController::class, 'login_post']);  // Handle login form

// Forgot Password Page (optional)
Route::view('/forgot', 'auth.forgot');
Route::post('forgot', [AuthController::class, 'forgot']);

Route::get('logout', [AuthController::class, 'logout']);

// Profile Management (Create, Store, and View Profile)
Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');  // Profile creation page
Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');  // Store profile data
Route::get('/profile', [ProfileController::class, 'index']);  // View profile

// Routes for users with different roles (Using middleware for role-based access)
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

Route::view('pilot', 'pilot/pilot_registration')->name('pilot');
Route::post('/pilot/register', [PilotController::class, 'store'])->name('pilot_register');

Route::view('/pilot/success', 'pilot.success')->name('pilot.success');
Route::view('/pilot/fail', 'pilot.fail')->name('pilot.fail');
