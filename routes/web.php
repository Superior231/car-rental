<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::prefix('/')->middleware('auth')->group(function() {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('cars', CarController::class);
});



// Admin
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function() {
    // dashboard
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/banner', [AdminController::class, 'bannerStore'])->name('admin.banner.store');
    Route::put('/banner/{id}', [AdminController::class, 'bannerUpdate'])->name('admin.banner.update');
    Route::delete('/banner/{id}', [AdminController::class, 'bannerDelete'])->name('admin.banner.delete');

    Route::resource('customers', CustomerController::class);
});


Route::get('/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');
