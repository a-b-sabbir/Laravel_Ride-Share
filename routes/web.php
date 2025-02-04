<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\Passenger\PassengerController;
use App\Http\Controllers\Pilot\LicenseController;
use App\Http\Controllers\Pilot\PilotController;
use App\Http\Controllers\PilotVehicleAssignmentController;
use App\Http\Controllers\SubAdmin\PilotController as SubAdminPilotController;
use App\Http\Controllers\SuperAdmin\PilotController as SuperAdminPilotController;
use App\Http\Controllers\SuperAdmin\ProfileController as SuperAdminProfileController;
use App\Http\Controllers\SubAdmin\ProfileController as SubAdminProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Vehicle\Bike\RegistrationCertificateController;
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

// Route::view('/pilot-phone', 'pilot.pilot_phone');
// Route::post('/send-otp', [PilotController::class, 'sendOtp'])->name('send-otp');

// // Route to show OTP input page
// Route::get('/verify-otp', [OtpController::class, 'showOtpForm'])->name('otp.form');

// // Route to handle OTP submission
// Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('otp.verify');


// Route for pilot registration
Route::post('/pilot/register', [PilotController::class, 'register'])->name('pilot.register');

Route::view('/pilot-registration', 'roles.pilot.pilot_registration');
Route::view('/pilot/fail', 'roles.pilot.fail')->name('pilot.fail');

// Route for license step
Route::get('/pilot/step/license/{pilot}', [LicenseController::class, 'showLicenseForm'])->name('show.pilot.license.form');
Route::post('/upload-license', [LicenseController::class, 'uploadLicense'])->name('license.upload');


// -------------------------------------------
// Vehicle Routes
// -------------------------------------------
Route::view('/vehicle/basic', 'vehicle.vehicle_form')->name('show.vehicle.form');

Route::post('/vehicle/basic/upload', [VehicleController::class, 'uploadVehicle'])->name('vehicle.upload');
Route::get('/vehicle/tax-token-form/{vehicleID}', [TaxTokenController::class, 'showTaxTokenForm'])->name('vehicle.taxTokenForm');
Route::post('/vehicle/tax-token', [TaxTokenController::class, 'uploadTaxToken'])->name('vehicle.uploadTaxToken');


Route::get('/vehicle/registration-paper/{vehicle}', [RegistrationCertificateController::class, 'showRegistrationCertificateForm'])->name('vehicle.registrationPaper');
Route::post('vehicle/registration-paper/upload', [RegistrationCertificateController::class, 'uploadRegistrationCertificate'])->name('upload.registration-certificate');


// -------------------------------------------
// Passenger Routes
// -------------------------------------------
Route::view('/passenger-registration', 'passenger.passenger_registration');
Route::post('/passenger/register', [PassengerController::class, 'store'])->name('passenger_register');

// -------------------------------------------
// Dashboard Routes
// -------------------------------------------
Route::middleware(['auth', SuperAdminMiddleware::class])->group(function () {
    Route::get('roles/super_admin/dashboard', [DashboardController::class, 'dashboard'])->name('super_admin.dashboard');
    Route::get('users', [UserController::class, 'index'])->name('user-management');
    Route::view('settings', 'roles.super_admin.settings.settings')->name('settings');
    Route::get('super_admin/assign-pilot-to-vehicle', [PilotVehicleAssignmentController::class, 'create'])->name('super_admin-assign-pilot-to-vehicle.create');
    Route::post('super_admin/assign-pilot-to-vehicle', [PilotVehicleAssignmentController::class, 'store'])->name('super_admin-assign-pilot-to-vehicle.store');
    Route::get('super_admin/assign-pilot-to-vehicle/{id}', [SuperAdminPilotController::class, 'show'])->name('super_admin-assign-pilot-to-vehicle.show');
    Route::get('super-admin/profile', [SuperAdminProfileController::class, 'show'])->name('super-admin.profile.show');
});

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('roles/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('admin/assign-pilot-to-vehicle', [PilotVehicleAssignmentController::class, 'create'])->name('assign-pilot-to-vehicle.create');
    Route::post('admin/assign-pilot-to-vehicle', [PilotVehicleAssignmentController::class, 'store'])->name('assign-pilot-to-vehicle.store');
});

Route::middleware(['auth', SubAdminMiddleware::class])->group(function () {
    Route::get('roles/sub_admin/dashboard', [DashboardController::class, 'dashboard'])->name('sub_admin.dashboard');
    Route::get('sub_admin/assign-pilot-to-vehicle', [PilotVehicleAssignmentController::class, 'create'])->name('assign-pilot-to-vehicle.create');
    Route::post('sub_admin/assign-pilot-to-vehicle', [PilotVehicleAssignmentController::class, 'store'])->name('assign-pilot-to-vehicle.store');
    Route::get('sub-admin/pilot/{id}', [SubAdminPilotController::class, 'show'])->name('pilot.show');

    Route::get('sub-admin/profile', [SubAdminProfileController::class, 'show'])->name('sub-admin.profile.show');
});

Route::middleware(['auth', PilotMiddleware::class])->group(function () {
    Route::get('pilot/dashboard', [DashboardController::class, 'dashboard'])->name('pilot.dashboard');
});

Route::middleware(['auth', PassengerMiddleware::class])->group(function () {
    Route::get('passenger/dashboard', [DashboardController::class, 'dashboard'])->name('passenger.dashboard');
});
