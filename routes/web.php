<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ReporterDashboardController;
use App\Http\Controllers\ReporterChatController;
use App\Http\Controllers\ReporterNotificationController;
use App\Http\Controllers\ReporterSettingsController;

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
Route::view('/faqs', 'reporter.faqs')->name('faqs');
Route::view('/about', 'about')->name('about');

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

// Protected Routes
Route::middleware('auth')->group(function () {
    // Redirect old dashboard URL to reporter dashboard
    Route::redirect('/dashboard', '/reporter/dashboard');

    // Reporter Routes
    Route::prefix('reporter')->name('reporter.')->group(function () {
        Route::get('/dashboard', [ReporterDashboardController::class, 'index'])->name('dashboard');
        Route::get('/case/{id}', [ReporterDashboardController::class, 'viewCase'])->name('case.view');
        Route::get('/notifications', [ReporterNotificationController::class, 'index'])->name('notifications');
        Route::get('/chat/{case}', [ReporterChatController::class, 'index'])->name('chat');
        Route::post('/chat/{case}', [ReporterChatController::class, 'sendMessage'])->name('chat.send');

        // Settings routes
        Route::get('/settings', [ReporterSettingsController::class, 'index'])->name('settings');
        Route::patch('/settings/profile', [ReporterSettingsController::class, 'updateProfile'])->name('settings.update-profile');
        Route::patch('/settings/password', [ReporterSettingsController::class, 'updatePassword'])->name('settings.update-password');
    });

    Route::get('/report/submit', [\App\Http\Controllers\Reporter\ReportController::class, 'create'])
        ->name('report.create');
    Route::post('/report/submit', [\App\Http\Controllers\Reporter\ReportController::class, 'store'])
        ->name('report.store');
    Route::view('/report/track', 'reporter.track-case')->name('report.track');
    Route::view('/officer/dashboard', 'officer.dashboard')->name('officer.dashboard');
    Route::view('/officer/cases', 'officer.cases')->name('officer.cases');
    Route::view('/officer/messages', 'officer.messages')->name('officer.messages');
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/admin/users', 'admin.users')->name('admin.users');
    Route::view('/admin/reports', 'admin.reports')->name('admin.reports');
    Route::view('/admin/settings', 'admin.settings')->name('admin.settings');
});
Route::view('/admin/reports', 'admin.reports')->name('admin.reports');
Route::view('/admin/settings', 'admin.settings')->name('admin.settings');

// Handle 404 and 500 error pages (for demonstration purposes)
Route::fallback(function () {
    return view('errors.404');
});
