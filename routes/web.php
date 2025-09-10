<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make simple routes.
|
*/

// Public Routes
Route::view('/', 'campussafeline')->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');
    Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'store']);
    Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'create'])->name('login');
    Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'store']);
});

Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Reporter Routes
Route::view('/report/submit', 'reporter.submit-report')
    ->middleware('auth')
    ->name('report.create');
Route::view('/report/track', 'reporter.track-case')->name('report.track');
Route::view('/faqs', 'reporter.faqs')->name('faqs');

// Officer Routes
Route::view('/officer/dashboard', 'officer.dashboard')->name('officer.dashboard');
Route::view('/officer/cases', 'officer.cases')->name('officer.cases');
Route::view('/officer/messages', 'officer.messages')->name('officer.messages');

// Admin Routes
Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
Route::view('/admin/users', 'admin.users')->name('admin.users');
Route::view('/admin/reports', 'admin.reports')->name('admin.reports');
Route::view('/admin/settings', 'admin.settings')->name('admin.settings');

// Handle 404 and 500 error pages (for demonstration purposes)
Route::fallback(function () {
    return view('errors.404');
});
