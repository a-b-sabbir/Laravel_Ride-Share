<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registration', function () {
    return view('/auth/registration');
});
Route::post('/register_post', [AuthController::class, 'register_post']);

Route::get('/login', function () {
    return view('/auth/login');
});
Route::post('/login_post', [AuthController::class, 'login_post']);

Route::get('/forgot', function () {
    return view('/auth/forgot');
});

Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');

Route::Post('/profile', [ProfileController::class, 'store'])->name('profile.store');
Route::get('/profile', [ProfileController::class, 'index']);
