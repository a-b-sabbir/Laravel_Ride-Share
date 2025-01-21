<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Passenger\PassengerController;
use App\Http\Controllers\Pilot\LicenseController;
use App\Http\Controllers\Pilot\PilotController;
use App\Http\Controllers\PilotVehicleAssignmentController;
use App\Http\Controllers\SuperAdmin\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Vehicle\RegistrationPaperController;
use App\Http\Controllers\Vehicle\TaxTokenController;
use App\Http\Controllers\Vehicle\VehicleController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\PassengerMiddleware;
use App\Http\Middleware\PilotMiddleware;
use App\Http\Middleware\SubAdminMiddleware;
use App\Http\Middleware\SuperAdminMiddleware;

use Illuminate\Support\Facades\Route;

// -------------------------------------------
// Public Routes
// -------------------------------------------
Route::get('/', function () {
    return view('welcome');
});

// -------------------------------------------
// Authentication Routes
// -------------------------------------------
Route::view('/chooseregistration', 'auth.chooseregistration');
Route::view('/login', 'auth.login');
Route::view('/forgot', 'auth.forgot');

Route::post('/login_post', [AuthController::class, 'login_post']);
Route::post('/forgot', [AuthController::class, 'forgot']);
Route::get('logout', [AuthController::class, 'logout']);

// -------------------------------------------
// Pilot Routes
// -------------------------------------------
Route::view('/pilot-registration', 'pilot.pilot_registration');
Route::post('/pilot/register', [PilotController::class, 'store'])->name('pilot_register');
Route::view('/pilot/fail', 'pilot.fail')->name('pilot.fail');

Route::get('/pilot/license', [LicenseController::class, 'showLicenseForm'])->name('pilot_license');
Route::post('/upload-license', [LicenseController::class, 'uploadLicense'])->name('license.upload');
Route::view('/license/success', 'pilot.success')->name('license.success');
Route::view('/license/fail', 'pilot.fail')->name('license.fail');

// -------------------------------------------
// Vehicle Routes
// -------------------------------------------
Route::view('/vehicle', 'vehicle.vehicle_form')->name('vehicle.register');
Route::post('/vehicle/register', [VehicleController::class, 'store'])->name('uploadVehicle');

Route::view('/vehicle/registration-photo', 'vehicle.registration_paper_photo')->name('registration_paper_photo');
Route::view('/vehicle/registration-form', 'vehicle.registration_paper_form')->name('registration_paper_form');
Route::post('vehicle/registration-paper', [RegistrationPaperController::class, 'uploadImage'])->name('uploadImage');

Route::post('/vehicle/tax-token-form', [TaxTokenController::class, 'showInfo'])->name('showTokenInfo');

// -------------------------------------------
// Passenger Routes
// -------------------------------------------
Route::view('/passenger-registration', 'passenger.passenger_registration');
Route::post('/passenger/register', [PassengerController::class, 'store'])->name('passenger_register');

// -------------------------------------------
// Dashboard Routes
// -------------------------------------------
Route::middleware(['auth', SuperAdminMiddleware::class])->group(function () {
    Route::get('super_admin/dashboard', [DashboardController::class, 'dashboard'])->name('super_admin.dashboard');
    Route::get('users', [UserController::class, 'index'])->name('user-management');
    Route::view('settings', 'super_admin.settings.settings')->name('settings');
    Route::get('super_admin/assign-pilot-to-vehicle', [PilotVehicleAssignmentController::class, 'create'])->name('super_admin-assign-pilot-to-vehicle.create');
    Route::post('super_admin/assign-pilot-to-vehicle', [PilotVehicleAssignmentController::class, 'store'])->name('super_admin-assign-pilot-to-vehicle.store');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
});

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('admin/assign-pilot-to-vehicle', [PilotVehicleAssignmentController::class, 'create'])->name('assign-pilot-to-vehicle.create');
    Route::post('admin/assign-pilot-to-vehicle', [PilotVehicleAssignmentController::class, 'store'])->name('assign-pilot-to-vehicle.store');
});

Route::middleware(['auth', SubAdminMiddleware::class])->group(function () {
    Route::get('sub_admin/dashboard', [DashboardController::class, 'dashboard'])->name('sub_admin.dashboard');
    Route::get('sub_admin/assign-pilot-to-vehicle', [PilotVehicleAssignmentController::class, 'create'])->name('assign-pilot-to-vehicle.create');
    Route::post('sub_admin/assign-pilot-to-vehicle', [PilotVehicleAssignmentController::class, 'store'])->name('assign-pilot-to-vehicle.store');
});

Route::middleware(['auth', PilotMiddleware::class])->group(function () {
    Route::get('pilot/dashboard', [DashboardController::class, 'dashboard'])->name('pilot.dashboard');
});

Route::middleware(['auth', PassengerMiddleware::class])->group(function () {
    Route::get('passenger/dashboard', [DashboardController::class, 'dashboard'])->name('passenger.dashboard');
});
