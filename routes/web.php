<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Registration and Login Pages (for browsers)
Route::view('/registration', 'auth.registration');  // Registration page
Route::post('/register_post', [AuthController::class, 'register_post']);  // Handle registration form

Route::view('/login', 'auth.login');  // Login page
Route::post('/login_post', [AuthController::class, 'login_post']);  // Handle login form

// Forgot Password Page (optional)
Route::get('/forgot', function () {
    return view('/auth.forgot');
});

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
