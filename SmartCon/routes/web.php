<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\WaitlistController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('courses', CourseController::class)->middleware('can:manage-courses');
    Route::resource('availabilities', AvailabilityController::class)->only(['index','create','store','edit','update','destroy'])->middleware('can:faculty-only');

    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create/{faculty}', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::patch('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel')->middleware('can:cancel,appointment');
    Route::patch('/appointments/{appointment}/reschedule', [AppointmentController::class, 'reschedule'])->name('appointments.reschedule')->middleware('can:reschedule,appointment');

    Route::post('/messages/{appointment}', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/{appointment}', [MessageController::class, 'index'])->name('messages.index');

    Route::post('/files/upload/{appointment}', [FileController::class, 'store'])->name('files.store');
    Route::get('/files/{file}/download', [FileController::class, 'download'])->name('files.download');

    Route::post('/feedback/{appointment}', [FeedbackController::class, 'store'])->name('feedback.store');

    Route::get('/admin/users', [DashboardController::class, 'users'])->name('admin.users')->middleware('can:admin-only');
    Route::get('/admin/analytics', [DashboardController::class, 'analytics'])->name('admin.analytics')->middleware('can:admin-only');
    Route::get('/waitlists', [DashboardController::class, 'waitlists'])->name('admin.waitlists');
    Route::get('/waitlists', [WaitlistController::class, 'index'])->name('waitlists.index');
    Route::post('/waitlists/{id}/accept', [WaitlistController::class, 'accept'])->name('waitlists.accept');
    Route::post('/waitlists/{id}/reject', [WaitlistController::class, 'reject'])->name('waitlists.reject');
// ...existing code...
});

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

require __DIR__.'/auth.php';
