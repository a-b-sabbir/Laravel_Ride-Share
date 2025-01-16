<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Pilot\LicenseController;
use App\Http\Controllers\Pilot\PilotController;
use App\Http\Controllers\PilotVehicleAssignmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Vehicle\RegistrationPaperController;
use App\Http\Controllers\Vehicle\TaxTokenController;
use App\Http\Controllers\Vehicle\VehicleController;
use App\Models\PilotVehicleAssignment;
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

// Routes for pilot registration
Route::view('/pilot-registration', 'pilot.pilot_registration');
Route::post('/pilot/register', [PilotController::class, 'store'])->name('pilot_register');
Route::view('/pilot/fail', 'pilot.fail')->name('pilot.fail');

// Routes for pilot license
Route::get('/pilot/license', [LicenseController::class, 'showLicenseForm'])->name('pilot_license');
Route::post('/upload-license', [LicenseController::class, 'uploadLicense'])->name('license.upload');

Route::view('/vehicle', 'vehicle.vehicle_form')->name('vehicle.register');
Route::post('/vehicle/register', [VehicleController::class, 'store'])->name('uploadVehicle');
Route::view('/vehicle/registration-photo', 'vehicle.registration_paper_photo')->name('registration_paper_photo');
Route::view('/vehicle/registration-form', 'vehicle.registration_paper_form')->name('registration_paper_form');

Route::post('vehicle/registration-paper', [RegistrationPaperController::class, 'uploadImage'])->name('uploadImage');


Route::post('/vehicle/tax-token-form', [TaxTokenController::class, 'showInfo'])->name('showTokenInfo');


Route::view('/license/success', 'pilot.success')->name('license.success');
Route::view('/license/fail', 'pilot.fail')->name('license.fail');


// Demo

Route::view('/demo', 'demo')->name('demo');



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



// Remove the 'role:sub_admin' middleware from here
Route::middleware(['auth'])->group(function () {
    Route::get('sub_admin/dashboard', [DashboardController::class, 'dashboard'])->name('sub_admin.dashboard');
    Route::get('assign-pilot-to-vehicle', [PilotVehicleAssignmentController::class, 'create'])->name('assign-pilot-to-vehicle.create');
    Route::post('assign-pilot-to-vehicle', [PilotVehicleAssignmentController::class, 'store'])->name('assign-pilot-to-vehicle.store');
});
