<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('alumni', AlumniController::class);
        Route::get('alumni/export', [AlumniController::class, 'export'])->name('alumni.export');
        Route::post('alumni/{alumni}/validate', [AlumniController::class, 'validatePddikti'])->name('alumni.validate');
    });
    
    Route::get('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});



