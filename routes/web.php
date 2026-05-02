<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TrackingController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/faq', 'faq');

Route::get('/stats', \App\Http\Controllers\StatsController::class)->name('stats');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/tracking-stats', [TrackingController::class, 'stats'])->name('admin.tracking.stats');
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

        Route::prefix('admin')->name('admin.')->group(function () {
            // ✅ Custom routes HARUS di atas resource route
            Route::get('alumni/export', [AlumniController::class, 'export'])->name('alumni.export');
            Route::post('alumni/{alumnus}/validate', [AlumniController::class, 'validatePddikti'])->name('alumni.validate');
            Route::post('alumni/import', [AlumniController::class, 'import'])->name('alumni.import');
            Route::post('alumni/bulk-track', [AlumniController::class, 'bulkTrack'])->name('alumni.bulk-track');
            Route::post('alumni/bulk-pddikti-verify', [AlumniController::class, 'bulkPddiktiVerify'])->name('alumni.bulk-pddikti-verify');

            // ✅ Resource route di bawah
            Route::resource('alumni', AlumniController::class)->parameters(['alumni' => 'alumnus']);
        });

    Route::get('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});