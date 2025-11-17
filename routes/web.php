<?php

use App\Http\Controllers\Appointment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\ClientMiddleware;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AppointmentController;

Route::get('/', [PublicController::class, 'home'])->name('homepage');
Route::get('/service', [PublicController::class, 'service'])->name('service');


Route::middleware(['auth'])->group(function () {
    Route::get('/appointment/create', [AppointmentController::class, 'create'])->name('appointment.create');
    Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');
});

Route::middleware(['auth', ClientMiddleware::class])->group(function () {
    Route::get('/client/index', [ClientController::class, 'index'])->name('client.index');
    Route::delete('client/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('client.appointments.destroy');
});


Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/appointments', [AdminController::class, 'index'])->name('admin.appointments');
    Route::delete('admin/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('admin.appointments.destroy');
});
