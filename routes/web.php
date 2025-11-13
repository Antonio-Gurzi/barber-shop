<?php

use App\Http\Controllers\Appointment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AppointmentController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', [PublicController::class, 'home'])->name('homepage');
Route::get('/service', [PublicController::class, 'service'])->name('service');


Route::middleware(['auth'])->group(function () {
    Route::get('/appointment/create', [AppointmentController::class, 'create'])->name('appointment.create');
    Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');
});

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/appointment/index', [AppointmentController::class, 'index'])->name('appointment.index');
});
