<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserStateController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\RequestStateController;
use App\Http\Controllers\LicensesStateController;
use App\Http\Controllers\LicenseRequestController;
use App\Http\Controllers\VisitSchedulesController;
use App\Http\Controllers\AssignInspectorController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


# Dashboard ........................................................................
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    // Route::get('/dashboard', [DashboardController::class, 'index']);
    // Route::get('/home', [HomeController::class, 'index'])->name('admin.home');
});

#....END DASHBOARD.................................................................

# Profile
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
});

#User...
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

#Institution...
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('institutions', [InstitutionController::class, 'index'])->name('admin.institutions.index');
    Route::get('institutions/create', [InstitutionController::class, 'create'])->name('admin.institutions.create');
    Route::post('institutions', [InstitutionController::class, 'store'])->name('admin.institutions.store');
    Route::get('institutions/{institution}', [InstitutionController::class, 'show'])->name('admin.institutions.show');
    Route::get('institutions/{institution}/edit', [InstitutionController::class, 'edit'])->name('admin.institutions.edit');
    Route::put('institutions/{institution}', [InstitutionController::class, 'update'])->name('admin.institutions.update');
    Route::delete('institutions/{institution}', [InstitutionController::class, 'destroy'])->name('admin.institutions.destroy');
});

#Update State Request ...
Route::middleware(['auth', 'verified'])->group(function () {
    Route::patch('license-requests/{licenseRequest}/state-update', RequestStateController::class)->name('license_requests.state_update');
    Route::patch('assign-inspector/{licenseRequest}/state-update', AssignInspectorController::class)->name('assign_inspector.state_update');
    Route::patch('licenses/{licenseRequest}/state-update', LicensesStateController::class)->name('licenses.state_update');
    Route::patch('users/{user}/state-update', UserStateController::class)->name('admin.users.state_update');
});

#License Request..
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('license-requests', [LicenseRequestController::class, 'index'])->name('license_requests.index');
    Route::get('license-requests/create', [LicenseRequestController::class, 'create'])->name('license_requests.create');
    Route::post('license-requests', [LicenseRequestController::class, 'store'])->name('license_requests.store');
    Route::get('license-requests/{licenseRequest}', [LicenseRequestController::class, 'show'])->name('license_requests.show');
    Route::get('license-requests/{licenseRequest}/edit', [LicenseRequestController::class, 'edit'])->name('license_requests.edit');
    Route::put('license-requests/{licenseRequest}', [LicenseRequestController::class, 'update'])->name('license_requests.update');
    Route::delete('license-requests/{licenseRequest}', [LicenseRequestController::class, 'destroy'])->name('license_requests.destroy');
});

#Visit Schedules..
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('visit-schedules', [VisitSchedulesController::class, 'index'])->name('visit_schedules.index');
    Route::get('visit-schedules/{visitSchedule}', [VisitSchedulesController::class, 'show'])->name('visit_schedules.show');
});


#License..
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('licenses', [LicenseController::class, 'index'])->name('licenses.index');
    Route::get('licenses/create/{licenseRequest}', [LicenseController::class, 'create'])->name('licenses.create');
    Route::post('licenses', [LicenseController::class, 'store'])->name('licenses.store');
    Route::get('licenses/{license}', [LicenseController::class, 'show'])->name('licenses.show');
    Route::get('licenses/{license}/edit', [LicenseController::class, 'edit'])->name('licenses.edit');
    Route::put('licenses/{license}', [LicenseController::class, 'update'])->name('licenses.update');
    Route::delete('licenses/{license}', [LicenseController::class, 'destroy'])->name('licenses.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/admin/reports/license-requests/pdf', [ReportController::class, 'exportPdf'])
        ->name('admin.reports.license_requests.pdf');

});


require __DIR__ . '/auth.php';


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');
